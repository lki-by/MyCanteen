<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->paginate(10);
        return view('admin.index', compact('menus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nm_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $menu = new Menu();
        $menu->nm_menu = $request->nm_menu;
        $menu->harga = $request->harga;
        $menu->kategori_id = $request->kategori_id;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $menu->gambar = $request->file('gambar')->store('menu', 'public');
        }

        $menu->save();

        return redirect()->route('admin.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nm_menu' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu->nm_menu = $request->nm_menu;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;
        $menu->kategori_id = $request->kategori_id;

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $menu->gambar = $request->file('gambar')->store('menu', 'public');
        }

        $menu->save();

        return redirect()->route('admin.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.index')->with('success', 'Menu berhasil dihapus.');
    }
}