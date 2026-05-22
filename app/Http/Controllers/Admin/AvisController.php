<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index()
    {
        // Avis depuis la table notifications ou table dédiée
        $avis = []; // À implémenter avec une vraie table avis
        return view('admin.avis.index', compact('avis'));
    }

    public function repondre(Request $request, $id)
    {
        return back()->with('success', 'Réponse envoyée');
    }

    public function destroy($id)
    {
        return back()->with('success', 'Avis supprimé');
    }
}