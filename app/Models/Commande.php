<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'commercant_id',
        'livreur_id',
        'total',
        'frais_livraison',
        'adresse_livraison',
        'statut',
        'mode_paiement',
        'zone_id',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function commercant()
    {
        return $this->belongsTo(Commercant::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
            ->withPivot('quantite', 'prix_unitaire')
            ->withTimestamps();
    }
}