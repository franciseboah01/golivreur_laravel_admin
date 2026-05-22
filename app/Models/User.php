<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'nom', 'prenom', 'telephone', 'email', 'password',
        'role', 'avatar', 'statut', 'zone_id', 'adresse', 'ville', 'quartier',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function commercant() { return $this->hasOne(Commercant::class); }
    public function livreur() { return $this->hasOne(Livreur::class); }
    public function notifications() { return $this->hasMany(Notification::class); }
    public function commandes() { return $this->hasMany(Commande::class, 'client_id'); }
    public function zone() { return $this->belongsTo(Zone::class); }
}