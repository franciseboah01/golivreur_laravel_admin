<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    protected $fillable = [
        'user_id',
        'vehicule_type',
        'vehicule_immatriculation',
        'photo_vehicule',
        'zone_couverture',
        'latitude_actuelle',
        'longitude_actuelle',
        'disponible',
        'statut',
        'zone_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}