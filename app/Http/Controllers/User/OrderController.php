<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $transactions = Transaksi::where('user_id', Auth::id())
            ->where('status', '!=', 'Belum Bayar')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('orders.index', compact('transactions'));
    }

    public function show(Transaksi $transaction)
    {
        
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }


        $transaction->load('cart.menu');

        return view('orders.show', compact('transaction'));
    }
     public function destroy(Transaksi $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow cancellation for certain statuses
        if (!in_array($transaction->status, ['Belum Bayar', 'Menunggu Pembayaran'])) {
            return back()->with('error', 'Order cannot be canceled at this stage.');
        }

        // Delete associated cart items first
        $transaction->cart()->delete();

        // Then delete the transaction
        $transaction->delete();

        return redirect()->route('user.orders.index')
            ->with('success', 'Order has been successfully canceled.');
    }
}
