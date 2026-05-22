<?php

namespace App\Services;

use App\Models\Commande;
use App\Models\Livreur;

class AttributionLivreurService
{
    public function attribuerAutomatiquement(Commande $commande): bool
    {
        $livreur = Livreur::where('disponible', true)
            ->where('statut', 'actif')
            ->first();

        if (!$livreur) {
            return false;
        }

        $commande->update([
            'livreur_id' => $livreur->id,
            'statut' => 'en_livraison',
        ]);

        $livreur->update(['disponible' => false]);

        return true;
    }

    public function libererLivreur(Commande $commande): void
    {
        if ($commande->livreur_id) {
            Livreur::where('id', $commande->livreur_id)
                ->update(['disponible' => true]);
        }
    }
}