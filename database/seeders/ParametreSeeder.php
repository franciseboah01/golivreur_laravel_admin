<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parametre;

class ParametreSeeder extends Seeder
{
    public function run(): void
    {
        $params = [
            ['cle' => 'frais_livraison_base', 'valeur' => '500', 'groupe' => 'livraison', 'description' => 'Frais de livraison de base (FCFA)'],
            ['cle' => 'frais_livraison_km', 'valeur' => '200', 'groupe' => 'livraison', 'description' => 'Frais par km supplémentaire (FCFA)'],
            ['cle' => 'rayon_max_livraison', 'valeur' => '20', 'groupe' => 'livraison', 'description' => 'Rayon max de livraison (km)'],
            ['cle' => 'commission_plateforme', 'valeur' => '10', 'groupe' => 'commission', 'description' => 'Commission plateforme (%)'],
            ['cle' => 'delai_preparation_defaut', 'valeur' => '15', 'groupe' => 'commande', 'description' => 'Délai préparation par défaut (min)'],
            ['cle' => 'bonus_livreur_km', 'valeur' => '100', 'groupe' => 'livreur', 'description' => 'Bonus livreur par km (FCFA)'],
            ['cle' => 'bonus_heure_pointe', 'valeur' => '200', 'groupe' => 'livreur', 'description' => 'Bonus heure de pointe (FCFA)'],
            ['cle' => 'heure_debut_pointe', 'valeur' => '18:00', 'groupe' => 'livreur', 'description' => 'Début heure de pointe'],
            ['cle' => 'heure_fin_pointe', 'valeur' => '21:00', 'groupe' => 'livreur', 'description' => 'Fin heure de pointe'],
            ['cle' => 'devise', 'valeur' => 'FCFA', 'groupe' => 'general', 'description' => 'Devise'],
            ['cle' => 'pays', 'valeur' => 'Côte d\'Ivoire', 'groupe' => 'general', 'description' => 'Pays'],
            ['cle' => 'indicatif', 'valeur' => '+225', 'groupe' => 'general', 'description' => 'Indicatif téléphonique'],
            ['cle' => 'nom_app', 'valeur' => 'GoLivreur', 'groupe' => 'general', 'description' => 'Nom de l\'application'],
            ['cle' => 'version_min_app', 'valeur' => '1.0.0', 'groupe' => 'general', 'description' => 'Version minimale requise'],
            ['cle' => 'maintenance', 'valeur' => '0', 'groupe' => 'general', 'description' => 'Mode maintenance (0/1)'],
        ];

        foreach ($params as $p) {
            Parametre::updateOrCreate(['cle' => $p['cle']], $p);
        }
    }
}