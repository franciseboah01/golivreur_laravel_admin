<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleAdmin;

class RoleAdminSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nom' => 'Super Admin', 'permissions' => ['*'], 'description' => 'Tous les droits'],
            ['nom' => 'Directeur Commercial', 'permissions' => ['dashboard', 'commercants', 'commandes', 'analytics', 'exports'], 'description' => 'Gestion commerciale'],
            ['nom' => 'Responsable Livreurs', 'permissions' => ['dashboard', 'livreurs', 'commandes', 'colis', 'zones'], 'description' => 'Gestion des livreurs'],
            ['nom' => 'Comptable', 'permissions' => ['dashboard', 'transactions', 'exports', 'analytics', 'comptabilite'], 'description' => 'Finance et comptabilité'],
            ['nom' => 'Analyste Données', 'permissions' => ['dashboard', 'analytics', 'exports', 'logs'], 'description' => 'Analyse des données'],
            ['nom' => 'Support Client', 'permissions' => ['dashboard', 'clients', 'avis', 'signalements', 'support', 'notifications'], 'description' => 'Support client'],
            ['nom' => 'Marketing', 'permissions' => ['dashboard', 'bannieres', 'codes_promo', 'notifications', 'marketing'], 'description' => 'Marketing et promotions'],
            ['nom' => 'Modérateur', 'permissions' => ['dashboard', 'avis', 'signalements', 'categories'], 'description' => 'Modération contenu'],
            ['nom' => 'Viewer', 'permissions' => ['dashboard'], 'description' => 'Consultation seule'],
            ['nom' => 'Admin Principal', 'permissions' => [
                'dashboard', 'clients', 'commercants', 'livreurs', 'commandes', 'colis',
                'categories', 'codes_promo', 'parametres', 'transactions', 'avis',
                'signalements', 'notifications', 'zones', 'bannieres', 'exports', 'logs',
            ], 'description' => 'Administrateur d\'une ville'],


        ];

        foreach ($roles as $role) {
            RoleAdmin::create([
                'nom' => $role['nom'],
                'permissions' => $role['permissions'],
                'description' => $role['description'],
                'actif' => true,
            ]);
        }
    }
}