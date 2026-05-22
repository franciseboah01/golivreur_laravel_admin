<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['nom' => 'Restauration', 'icone' => '🍔', 'ordre' => 1],
            ['nom' => 'Épicerie', 'icone' => '🛒', 'ordre' => 2],
            ['nom' => 'Pharmacie', 'icone' => '💊', 'ordre' => 3],
            ['nom' => 'Mode', 'icone' => '👗', 'ordre' => 4],
            ['nom' => 'Boucherie', 'icone' => '🥩', 'ordre' => 5],
            ['nom' => 'Boulangerie', 'icone' => '🥖', 'ordre' => 6],
            ['nom' => 'Électronique', 'icone' => '💻', 'ordre' => 7],
            ['nom' => 'Beauté', 'icone' => '🧴', 'ordre' => 8],
            ['nom' => 'Services', 'icone' => '🛠️', 'ordre' => 9],
        ];

        foreach ($cats as $c) {
            Categorie::create($c);
        }
    }
}