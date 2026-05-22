<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'nom' => 'Admin',
            'prenom' => 'GoLivreur',
            'email' => 'admin@golivreur.com',
            'telephone' => '0700000099',
            'password' => 'admin123',
            'role_admin' => 'super_admin',
            'actif' => true,
        ]);
    }
}