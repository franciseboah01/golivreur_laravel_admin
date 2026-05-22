<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Http\Request;

class ColisController extends Controller
{
    public function index(Request $request)
    {
        $query = Colis::with('expediteur', 'livreur.user');

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        // Filtrage par zone
        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        } elseif (auth('admin')->user()->zone_id) {
            $query->where('zone_id', auth('admin')->user()->zone_id);
        }

        $colis = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.colis.index', compact('colis'));
    }

    public function show($id)
    {
        $colis = Colis::with('expediteur', 'livreur.user')->findOrFail($id);
        $livreurs = Livreur::with('user')->where('disponible', true)->where('statut', 'actif')->get();
        return view('admin.colis.show', compact('colis', 'livreurs'));
    }
}