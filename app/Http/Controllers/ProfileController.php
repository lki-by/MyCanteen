<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Mengupdate data profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:5000'
        ]);


        $user->name = $validated['name'];
        $user->phone = $validated['phone'];


        if ($request->hasFile('avatar')) {

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

           
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Menghapus avatar profil
     */
    public function destroyAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            // Hapus file dari storage
            Storage::disk('public')->delete($user->avatar);

            // Hapus referensi di database
            $user->avatar = null;
            $user->save();
        }

        return redirect()->route('profile.edit')
            ->with('success', 'Foto profil berhasil dihapus!');
    }
}
