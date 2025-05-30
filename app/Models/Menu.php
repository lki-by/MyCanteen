<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['nm_menu','gambar','harga','deskripsi','kategori_id'];


    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

}
