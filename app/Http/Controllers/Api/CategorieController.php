<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function liste()
    {
        return response()->json(Categorie::where('actif', true)->orderBy('ordre')->get());
    }
}