<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Borrowing;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Statistik
        $totalBorrowings = Borrowing::where('user_id', $userId)->count();
        $activeBorrowings = Borrowing::where('user_id', $userId)->where('status', 'dipinjam')->count();
        $returnedBorrowings = Borrowing::where('user_id', $userId)->where('status', 'dikembalikan')->count();
        $lateBorrowings = Borrowing::where('user_id', $userId)->where('status', 'terlambat')->count();

        // Riwayat
        $recentBorrowings = Borrowing::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->with('book')
            ->get();

        return view('peminjam.profile', compact(
            'user',
            'totalBorrowings',
            'activeBorrowings',
            'returnedBorrowings',
            'lateBorrowings',
            'recentBorrowings'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update basic data
        $user->update($request->only('name','email','phone','address'));

        // Update password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah!']);
            }
            $user->password = Hash::make($request->password);
        }

        // Update image
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->image = $request->file('image')->store('users', 'public');
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
