<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $fillable = ['cle', 'valeur', 'groupe', 'description'];

    public static function get($cle, $default = null)
    {
        $p = self::where('cle', $cle)->first();
        return $p ? $p->valeur : $default;
    }

    public static function getGroupe($groupe)
    {
        return self::where('groupe', $groupe)->pluck('valeur', 'cle')->toArray();
    }
}