<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Commercant;
use App\Models\Livreur;
use App\Models\Commande;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_commercants' => Commercant::count(),
            'total_livreurs' => Livreur::count(),
            'total_commandes' => Commande::count(),
            'commandes_du_jour' => Commande::whereDate('created_at', today())->count(),
            'commandes_en_attente' => Commande::where('statut', 'en_attente')->count(),
            'commandes_en_livraison' => Commande::where('statut', 'en_livraison')->count(),
            'commandes_livrees' => Commande::where('statut', 'livree')->count(),
            'revenus_total' => Commande::where('statut', 'livree')->sum('total'),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}