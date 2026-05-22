<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function liste()
    {
        return response()->json(Parametre::all());
    }

    public function groupe($groupe)
    {
        return response()->json(Parametre::getGroupe($groupe));
    }

    public function mettreAJour(Request $request)
    {
        foreach ($request->all() as $cle => $valeur) {
            Parametre::updateOrCreate(['cle' => $cle], ['valeur' => $valeur]);
        }
        return response()->json(['message' => 'OK']);
    }
}