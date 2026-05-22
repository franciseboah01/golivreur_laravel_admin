<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'commercant_id',
        'nom',
        'description',
        'prix',
        'photo',
        'categorie',
        'disponible',
        'stock',
    ];

    public function commercant()
    {
        return $this->belongsTo(Commercant::class);
    }
}