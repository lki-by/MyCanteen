<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chart extends Model
{
    protected $table = 'charts';
    protected $fillable = ['transaksi_id','menu_id','user_id','quantity','total'];

    protected static function booted(): void
{
    static::creating(function (Chart $cart) {
        $transaction = Transaksi::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'Belum Bayar'],
            ['total_bayar' => 0]
        );

        $cart->transaksi_id = $transaction->id;
        $cart->user_id = Auth::id();
        $cart->total = $cart->quantity * $cart->menu->harga;
    });

    static::updating(function (Chart $cart) {
        $cart->total = $cart->quantity * $cart->menu->harga;
    });
}
     public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
