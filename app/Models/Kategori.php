<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['nm_kategori'];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'kategori_id','id');
    }


}
