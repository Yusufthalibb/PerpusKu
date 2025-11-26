<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // =======================
    // TAMPILKAN PROFIL
    // =======================
    public function profile()
    {
        $user = Auth::user();

        return view('petugas.profile', [
            'user' => $user,
            'activeBorrowings' => $user->borrowings()->where('status', 'dipinjam')->count(),
            'totalBorrowings' => $user->borrowings()->count(),
            'returnedBorrowings' => $user->borrowings()->where('status', 'dikembalikan')->count(),
            'lateBorrowings' => $user->borrowings()->where('status', 'terlambat')->count(),
            'recentBorrowings' => $user->borrowings()->latest()->take(5)->get(),
        ]);
    }

    // =======================
    // UPDATE DATA PROFIL
    // =======================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto baru
        if ($request->hasFile('image')) {
            // hapus file lama jika ada
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // simpan file baru
            $path = $request->file('image')->store('profile', 'public');
            $user->image = $path;
        }

        // update data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // =======================
    // UPDATE PASSWORD
    // =======================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();

        // cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        // update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}
