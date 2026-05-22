<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Livreur;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::with('client', 'commercant', 'livreur.user');

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }
        if ($request->search) {
            $query->where('id', $request->search)
                ->orWhereHas('client', fn($q) => $q->where('nom', 'like', "%{$request->search}%"));
        }

        // Filtrage par zone
        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        } elseif (auth('admin')->user()->zone_id) {
            $query->where('zone_id', auth('admin')->user()->zone_id);
        }

        $commandes = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.commandes.index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::with('client', 'commercant.user', 'livreur.user', 'produits')->findOrFail($id);
        $livreurs = Livreur::with('user')->where('disponible', true)->where('statut', 'actif')->get();
        return view('admin.commandes.show', compact('commande', 'livreurs'));
    }

    public function changerStatut(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => $request->statut]);

        if ($request->statut === 'livree') {
            Livreur::where('id', $commande->livreur_id)->update(['disponible' => true]);
        }

        return back()->with('success', 'Statut mis à jour : ' . $request->statut);
    }

    public function attribuer(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->update([
            'livreur_id' => $request->livreur_id,
            'statut' => 'en_livraison',
        ]);

        Livreur::where('id', $request->livreur_id)->update(['disponible' => false]);

        return back()->with('success', 'Livreur attribué');
    }
}