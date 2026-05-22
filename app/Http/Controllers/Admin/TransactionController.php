<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('client', 'commercant', 'livreur.user')
            ->whereIn('statut', ['livree', 'en_livraison', 'acceptee'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $total = Commande::where('statut', 'livree')->sum('total');
        $commission = $total * 0.10;

        return view('admin.transactions.index', compact('commandes', 'total', 'commission'));
    }

    public function retraits()
    {
        return view('admin.retraits.index');
    }

    public function traiterRetrait(Request $request, $id)
    {
        return back()->with('success', 'Retrait traité');
    }
}