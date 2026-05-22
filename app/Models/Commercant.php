<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commercant extends Model
{
    protected $fillable = [
        'user_id', 'nom_boutique', 'description', 'adresse',
        'telephone_boutique', 'photo_boutique', 'categorie',
        'latitude', 'longitude', 'horaires', 'ouvert', 'statut', 'zone_id',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function produits() { return $this->hasMany(Produit::class); }
    public function zone() { return $this->belongsTo(Zone::class); }
}