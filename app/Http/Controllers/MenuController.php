<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
public function index()
{
    $menus = Menu::with('kategori')->get();
    return view('mycanteen', compact('menus'));
}
}
