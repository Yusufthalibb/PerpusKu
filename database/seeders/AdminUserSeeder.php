<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user Admin
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@perpus.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password: password
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Jl. Perpustakaan No. 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat user Petugas
        DB::table('users')->insert([
            'name' => 'Petugas Satu',
            'username' => 'petugas',
            'email' => 'petugas@perpus.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password: password
            'role' => 'petugas',
            'phone' => '08198765432',
            'address' => 'Jl. Perpustakaan No. 2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat beberapa user peminjam untuk testing
        $peminjamData = [
            [
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@member.test',
                'password' => Hash::make('password'),
                'role' => 'peminjam',
                'phone' => '08199887766',
                'address' => 'Jl. Gatot Subroto No. 5',
            ],
        ];

        foreach ($peminjamData as $peminjam) {
            DB::table('users')->insert(array_merge($peminjam, [
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}