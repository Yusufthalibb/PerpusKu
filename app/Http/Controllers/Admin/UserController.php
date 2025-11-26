<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas,peminjam',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hash password
        $validated['password'] = bcrypt($validated['password']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('users', 'public');
        }

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas,peminjam',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $validated['image'] = $request->file('image')->store('users', 'public');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | ✨ Fitur Tambahan: Admin Melihat & Mengedit Profil Dirinya Sendiri
    |--------------------------------------------------------------------------
    */

    // 🟦  Admin lihat profilnya sendiri
    public function profile()
    {
        $user = auth()->user(); // admin yang login
        return view('admin.profile', compact('user'));
    }

    // 🟦  Admin update profilnya sendiri
    public function updateProfile(Request $request)
    {
        $user = auth()->user(); // admin yang login

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Upload Foto Baru
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $validated['image'] = $request->file('image')->store('users', 'public');
        }

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update data admin
        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
        // 🟦 Admin ubah password
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah current password benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.'
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}

