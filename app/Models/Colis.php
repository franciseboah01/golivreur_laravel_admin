<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    protected $fillable = [
        'expediteur_id',
        'destinataire_nom',
        'destinataire_telephone',
        'adresse_ramassage',
        'adresse_livraison',
        'description',
        'taille',
        'poids',
        'prix_livraison',
        'livreur_id',
        'statut',
        'mode_paiement',
        'code_confirmation',
        'zone_id',
    ];

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}