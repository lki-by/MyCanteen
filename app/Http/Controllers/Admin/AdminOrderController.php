<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of all orders.
     */
    public function index()
    {
        $items = Menu::with('kategori');
        $transactions = Transaksi::with(['user', 'cart'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('transactions'));
    }

    /**
     * Display the specified order.
     */
    public function show(Transaksi $transaction)
    {
        $transaction->load(['user', 'cart.menu']);

        return view('admin.orders.show', [
            'transaction' => $transaction,
            'items' => $transaction->cart
        ]);
    }

    /**
     * Update the order status.
     */
    public function update(Request $request, Transaksi $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:Selesai,Dibatalkan,Diproses,Menunggu Pembayaran,Belum Bayar'
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully');
    }
}
