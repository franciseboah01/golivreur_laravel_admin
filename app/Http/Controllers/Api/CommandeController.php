<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Commercant;
use App\Models\Livreur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AttributionLivreurService;
use App\Services\NotificationService;

class CommandeController extends Controller
{
    // Passer une commande (client)
    public function passer(Request $request)
    {
        $utilisateur = $request->user();

        if ($utilisateur->role !== 'client') {
            return response()->json(['message' => 'Seul un client peut passer commande'], 403);
        }

        $validateur = Validator::make($request->all(), [
            'commercant_id' => 'required|exists:commercants,id',
            'produits' => 'required|array|min:1',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'adresse_livraison' => 'required|string',
            'mode_paiement' => 'nullable|in:especes,mobile_money',
        ]);

        if ($validateur->fails()) {
            return response()->json(['erreur' => $validateur->errors()], 422);
        }

        // Calculer le total
        $total = 0;
        $produitsCommande = [];

        foreach ($request->produits as $item) {
            $produit = Produit::find($item['id']);
            $quantite = $item['quantite'];
            $prixTotal = $produit->prix * $quantite;
            $total += $prixTotal;

            $produitsCommande[] = [
                'produit_id' => $produit->id,
                'quantite' => $quantite,
                'prix_unitaire' => $produit->prix,
            ];
        }

        $fraisLivraison = 500; // Frais fixes pour le MVP

        $commande = Commande::create([
            'client_id' => $utilisateur->id,
            'commercant_id' => $request->commercant_id,
            'total' => $total,
            'frais_livraison' => $fraisLivraison,
            'adresse_livraison' => $request->adresse_livraison,
            'mode_paiement' => $request->mode_paiement ?? 'especes',
            'statut' => 'en_attente',
            'code_confirmation' => strtoupper(\Illuminate\Support\Str::random(6)),
        ]);

        // Notification au commerçant
        $notifService = new NotificationService();
        $commercant = Commercant::find($request->commercant_id);
        $notifService->notifierCommercantNouvelleCommande($commercant->user_id, $commande->id);


        // Attacher les produits
        foreach ($produitsCommande as $pc) {
            $commande->produits()->attach($pc['produit_id'], [
                'quantite' => $pc['quantite'],
                'prix_unitaire' => $pc['prix_unitaire'],
            ]);
        }

        return response()->json([
            'message' => 'Commande passée avec succès',
            'commande' => $commande->load('produits'),
        ], 201);
    }

    // Voir ses commandes (client)
    public function mesCommandes(Request $request)
    {
        $commandes = Commande::with('produits', 'commercant.user')
            ->where('client_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($commandes);
    }

    // Voir une commande spécifique
    public function detail($id, Request $request)
    {
        $commande = Commande::with('produits', 'commercant.user', 'livreur.user')
            ->find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        return response()->json($commande);
    }

    // Commandes reçues (commerçant)
    public function commandesRecues(Request $request)
    {
        $utilisateur = $request->user();
        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        if (!$commercant) {
            return response()->json(['message' => 'Profil commerçant non trouvé'], 404);
        }

        $commandes = Commande::with('produits', 'client')
            ->where('commercant_id', $commercant->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($commandes);
    }

    // Changer le statut (commerçant : accepter, en préparation)
    public function changerStatut(Request $request, $id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $request->validate([
            'statut' => 'required|in:acceptee,en_preparation,en_livraison,livree,annulee',
        ]);

        // Si livrée, vérifier le code de confirmation
        if ($request->statut === 'livree') {
            if (!$request->code_confirmation || $request->code_confirmation !== $commande->code_confirmation) {
                return response()->json(['message' => 'Code de confirmation incorrect'], 400);
            }
            $service = new AttributionLivreurService();
            $service->libererLivreur($commande);
        }

        $commande->update(['statut' => $request->statut]);

        // Notification au client
        $notifService = new NotificationService();
        $notifService->notifierClientChangementStatut($commande->client_id, $commande->id, $request->statut);

        // Si le commerçant accepte, déclencher l'attribution automatique
        if ($request->statut === 'acceptee') {
            $service = new AttributionLivreurService();
            $attribue = $service->attribuerAutomatiquement($commande);

            if ($attribue) {
                $livreur = Livreur::find($commande->livreur_id);
                $notifService->notifierLivreurNouvelleCourse($livreur->user_id, $commande->id);

                return response()->json([
                    'message' => 'Commande acceptée et livreur attribué automatiquement',
                    'commande' => $commande->fresh(),
                ]);
            } else {
                return response()->json([
                    'message' => 'Commande acceptée, mais aucun livreur disponible. En attente.',
                    'commande' => $commande->fresh(),
                ]);
            }
        }

        return response()->json([
            'message' => 'Statut mis à jour',
            'commande' => $commande->fresh(),
        ]);
    }

    // Commandes disponibles pour les livreurs
    public function disponiblesLivreur(Request $request)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        $commandes = Commande::with('commercant.user')
            ->where('statut', 'acceptee')
            ->whereNull('livreur_id')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($commandes);
    }

    // Accepter une livraison (livreur)
    public function accepterLivraison(Request $request, $id)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        $commande = Commande::where('id', $id)
            ->where('statut', 'acceptee')
            ->whereNull('livreur_id')
            ->first();

        if (!$commande) {
            return response()->json(['message' => 'Commande non disponible'], 404);
        }

        $commande->update([
            'livreur_id' => $livreur->id,
            'statut' => 'en_livraison',
        ]);

        return response()->json([
            'message' => 'Livraison acceptée',
            'commande' => $commande,
        ]);
    }

        // Commandes du livreur connecté
    public function mesLivraisons(Request $request)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        $commandes = Commande::with('client', 'commercant.user')
            ->where('livreur_id', $livreur->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($commandes);
    }
}