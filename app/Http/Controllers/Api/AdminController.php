<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Commercant;
use App\Models\Livreur;
use App\Models\User;
use Illuminate\Http\Request;

use App\Services\AttributionLivreurService;

class AdminController extends Controller
{
    // Vérifier si l'utilisateur est admin
    private function verifierAdmin($utilisateur)
    {
        if ($utilisateur->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Réservé administrateur.'], 403);
        }
        return null;
    }

    // Dashboard statistiques
    public function dashboard(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        return response()->json([
            'total_clients' => User::where('role', 'client')->count(),
            'total_commercants' => Commercant::count(),
            'total_livreurs' => Livreur::count(),
            'total_commandes' => Commande::count(),
            'commandes_du_jour' => Commande::whereDate('created_at', today())->count(),
            'commandes_en_attente' => Commande::where('statut', 'en_attente')->count(),
            'commandes_en_livraison' => Commande::where('statut', 'en_livraison')->count(),
            'commandes_livrees' => Commande::where('statut', 'livree')->count(),
            'revenus_total' => Commande::where('statut', 'livree')->sum('total'),
        ]);
    }

    // Liste de tous les utilisateurs
    public function utilisateurs(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $utilisateurs = User::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($utilisateurs);
    }

    // Commerçants en attente de validation
    public function commercantsEnAttente(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $commercants = Commercant::with('user')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($commercants);
    }

    // Valider un commerçant
    public function validerCommercant(Request $request, $id)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $commercant = Commercant::find($id);
        if (!$commercant) {
            return response()->json(['message' => 'Commerçant non trouvé'], 404);
        }

        $request->validate([
            'statut' => 'required|in:actif,inactif',
        ]);

        $commercant->update(['statut' => $request->statut]);

        return response()->json([
            'message' => 'Statut mis à jour',
            'commercant' => $commercant,
        ]);
    }

    // Livreurs en attente de validation
    public function livreursEnAttente(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $livreurs = Livreur::with('user')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($livreurs);
    }

    // Valider un livreur
    public function validerLivreur(Request $request, $id)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $livreur = Livreur::find($id);
        if (!$livreur) {
            return response()->json(['message' => 'Livreur non trouvé'], 404);
        }

        $request->validate([
            'statut' => 'required|in:actif,inactif',
        ]);

        $livreur->update(['statut' => $request->statut]);

        return response()->json([
            'message' => 'Statut mis à jour',
            'livreur' => $livreur,
        ]);
    }

    // Toutes les commandes
    public function commandes(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $commandes = Commande::with('client', 'commercant.user', 'livreur.user', 'produits')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($commandes);
    }

    // Attribuer manuellement un livreur à une commande
    public function attribuerLivreur(Request $request, $id)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $commande = Commande::find($id);
        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $request->validate([
            'livreur_id' => 'required|exists:livreurs,id',
        ]);

        $commande->update([
            'livreur_id' => $request->livreur_id,
            'statut' => 'en_livraison',
        ]);

        return response()->json([
            'message' => 'Livreur attribué avec succès',
            'commande' => $commande,
        ]);
    }

    // Attribution automatique des livreurs pour toutes les commandes en attente
    public function attributionAuto(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $service = new AttributionLivreurService();
        $commandes = Commande::where('statut', 'acceptee')
            ->whereNull('livreur_id')
            ->get();

        $attribuees = 0;
        foreach ($commandes as $commande) {
            if ($service->attribuerAutomatiquement($commande)) {
                $attribuees++;
            }
        }

        return response()->json([
            'message' => "Attribution terminée : $attribuees commande(s) attribuée(s)",
            'total_commandes' => $commandes->count(),
            'commandes_attribuees' => $attribuees,
        ]);
    }

    // Créer un compte admin (depuis un compte existant)
    public function creerAdmin(Request $request)
    {
        if ($erreur = $this->verifierAdmin($request->user())) return $erreur;

        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'telephone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $admin = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'password' => $request->password,
            'role' => 'required|in:client,livreur,commercant,admin',
        ]);

        return response()->json([
            'message' => 'Compte admin créé',
            'utilisateur' => $admin,
        ], 201);
    }
}