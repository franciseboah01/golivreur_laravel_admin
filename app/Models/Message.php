<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['commande_id', 'colis_id', 'expediteur_id', 'destinataire_id', 'contenu', 'lu'];
    public function expediteur() { return $this->belongsTo(User::class, 'expediteur_id'); }
}