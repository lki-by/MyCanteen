<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1'
        ]);


        $cartItem = Chart::where('user_id', Auth::id())
                        ->where('menu_id', $request->menu_id)
                        ->whereHas('transaksi', function($query) {
                            $query->where('status', 'Belum Bayar');
                        })
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->total = $cartItem->quantity * $request->price;
            $cartItem->save();
        } else {

            Chart::create([
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
                'total' => $request->quantity * $request->price
            ]);
        }

        return response()->json(['message' => 'Item added to cart successfully']);
    }
    public function processCheckout()
{
    $transaction = Transaksi::where('user_id', Auth::id())
                          ->where('status', 'Belum Bayar')
                          ->first();

    if (!$transaction || $transaction->cart->isEmpty()) {
        return response()->json(['message' => 'Cart is empty'], 400);
    }

    $total = $transaction->cart->sum('total');

    $transaction->update([
        'total_bayar' => $total,
        'status' => 'Menunggu Pembayaran',
        'tanggal' => now()
    ]);

    return response()->json([
        'message' => 'Checkout successful',
        'total' => $total
    ]);
}

    public function getCartItems()
    {
        $transaction = Transaksi::with('cart.menu')
                                ->where('user_id', Auth::id())
                                ->where('status', 'Belum Bayar')
                                ->first();

        return response()->json($transaction ? $transaction->cart : []);
    }

public function updateCartItem(Request $request)
{
    $request->validate([
        'cart_item_id' => 'required|exists:charts,id',
        'change' => 'required|integer'
    ]);

    $cartItem = Chart::where('id', $request->cart_item_id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

    $cartItem->quantity += $request->change;


    if ($cartItem->quantity < 1) {
        $cartItem->delete();
    } else {
        $cartItem->total = $cartItem->quantity * $cartItem->menu->harga;
        $cartItem->save();
    }

    return response()->json(['message' => 'Quantity updated successfully']);
}

public function removeCartItem(Request $request)
{
    $request->validate([
        'cart_item_id' => 'required|exists:charts,id'
    ]);

    Chart::where('id', $request->cart_item_id)
         ->where('user_id', Auth::id())
         ->delete();

    return response()->json(['message' => 'Item removed successfully']);
}

public function getCartCount()
{
    $count = Chart::whereHas('transaksi', function($query) {
                $query->where('user_id', Auth::id())
                      ->where('status', 'Belum Bayar');
            })
            ->count();

    return response()->json(['count' => $count]);
}
}
