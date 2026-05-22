<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livreur;

class LivreurController extends Controller
{
   public function index(Request $request)
    {
        $query = Livreur::with('user');

        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        } elseif (auth('admin')->user()->zone_id) {
            $query->where('zone_id', auth('admin')->user()->zone_id);
        }

        $livreurs = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.livreurs.index', compact('livreurs'));
    }

    public function enAttente()
    {
        $livreurs = Livreur::with('user')->where('statut', 'en_attente')->paginate(20);
        return view('admin.livreurs.attente', compact('livreurs'));
    }

    public function show($id)
    {
        $livreur = Livreur::with('user')->findOrFail($id);
        return view('admin.livreurs.show', compact('livreur'));
    }

    public function valider($id)
    {
        Livreur::findOrFail($id)->update(['statut' => 'actif']);
        return back()->with('success', 'Livreur validé');
    }

    public function toggle($id)
    {
        $l = Livreur::findOrFail($id);
        $l->update(['statut' => $l->statut === 'actif' ? 'inactif' : 'actif']);
        return back()->with('success', 'Statut modifié');
    }

    public function edit($id)
    {
        $livreur = Livreur::with('user')->findOrFail($id);
        return view('admin.livreurs.edit', compact('livreur'));
    }

    public function update(Request $request, $id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->update($request->only('vehicule_type', 'vehicule_immatriculation', 'zone_couverture'));
        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur mis à jour');
    }
}