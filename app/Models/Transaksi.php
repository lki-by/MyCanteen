<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = ['user_id','total_bayar','tanggal','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function cart()
    {
        return $this->hasMany(Chart::class, 'transaksi_id');
    }

protected $dates = ['tanggal'];

protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->tanggal = now(); 
    });
}
    protected $casts = [
    'status' => 'string',
    'tanggal' => 'datetime'
];

public const STATUSES = [
    'Belum Bayar',
    'Menunggu Pembayaran',
    'Diproses',
    'Selesai',
    'Dibatalkan'
];
}
