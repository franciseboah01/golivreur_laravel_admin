<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodePromo extends Model
{
    protected $table = 'codes_promo';

    protected $fillable = [
        'code', 'type', 'valeur', 'montant_min',
        'max_utilisation', 'utilisations', 'expire_le', 'actif',
    ];

    protected $casts = [
        'expire_le' => 'datetime',
        'actif' => 'boolean',
    ];
}