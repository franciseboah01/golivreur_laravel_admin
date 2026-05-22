<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'nom', 'code', 'latitude', 'longitude',
        'rayon_km', 'frais_livraison_base', 'frais_livraison_km', 'actif',
    ];

    protected $casts = ['actif' => 'boolean'];

    public function users() { return $this->hasMany(User::class); }
    public function commercants() { return $this->hasMany(Commercant::class); }
    public function livreurs() { return $this->hasMany(Livreur::class); }
    public function commandes() { return $this->hasMany(Commande::class); }
    public function colis() { return $this->hasMany(Colis::class); }
    public function admins() { return $this->hasMany(Admin::class); }
}