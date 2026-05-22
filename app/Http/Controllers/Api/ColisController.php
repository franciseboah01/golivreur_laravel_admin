<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ColisController extends Controller
{
    // Créer un colis (expéditeur)
    public function creer(Request $request)
    {
        $validateur = Validator::make($request->all(), [
            'destinataire_nom' => 'required|string|max:100',
            'destinataire_telephone' => 'required|string|max:15',
            'adresse_ramassage' => 'required|string',
            'adresse_livraison' => 'required|string',
            'description' => 'nullable|string',
            'taille' => 'nullable|in:petit,moyen,grand',
            'poids' => 'nullable|numeric|min:0',
            'mode_paiement' => 'nullable|in:especes,mobile_money',
        ]);

        if ($validateur->fails()) {
            return response()->json(['erreur' => $validateur->errors()], 422);
        }

        // Calculer le prix de livraison (simple : fixe + taille)
        $prix = 1000; // prix de base
        switch ($request->taille) {
            case 'moyen': $prix = 1500; break;
            case 'grand': $prix = 2000; break;
        }

        $colis = Colis::create([
            'expediteur_id' => $request->user()->id,
            'destinataire_nom' => $request->destinataire_nom,
            'destinataire_telephone' => $request->destinataire_telephone,
            'adresse_ramassage' => $request->adresse_ramassage,
            'adresse_livraison' => $request->adresse_livraison,
            'description' => $request->description,
            'taille' => $request->taille ?? 'petit',
            'poids' => $request->poids,
            'prix_livraison' => $prix,
            'mode_paiement' => $request->mode_paiement ?? 'especes',
            'code_confirmation' => strtoupper(Str::random(6)),
        ]);

        return response()->json([
            'message' => 'Colis créé avec succès',
            'colis' => $colis,
        ], 201);
    }

    // Mes colis expédiés
    public function mesEnvois(Request $request)
    {
        $colis = Colis::with('livreur.user')
            ->where('expediteur_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($colis);
    }

    // Détail d'un colis
    public function detail($id)
    {
        $colis = Colis::with('expediteur', 'livreur.user')->find($id);

        if (!$colis) {
            return response()->json(['message' => 'Colis non trouvé'], 404);
        }

        return response()->json($colis);
    }

    // Colis disponibles pour les livreurs
    public function disponiblesLivreur(Request $request)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        $colis = Colis::with('expediteur')
            ->where('statut', 'en_attente')
            ->whereNull('livreur_id')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($colis);
    }

    // Livreur accepte un colis
    public function accepter(Request $request, $id)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        $colis = Colis::where('id', $id)
            ->where('statut', 'en_attente')
            ->whereNull('livreur_id')
            ->first();

        if (!$colis) {
            return response()->json(['message' => 'Colis non disponible'], 404);
        }

        $colis->update([
            'livreur_id' => $livreur->id,
            'statut' => 'accepte',
        ]);

        $livreur->update(['disponible' => false]);

        return response()->json([
            'message' => 'Colis accepté',
            'colis' => $colis,
        ]);
    }

    // Changer le statut du colis
    public function changerStatut(Request $request, $id)
    {
        $colis = Colis::find($id);

        if (!$colis) {
            return response()->json(['message' => 'Colis non trouvé'], 404);
        }

        $request->validate([
            'statut' => 'required|in:ramasse,en_livraison,livre,annule',
        ]);

        if ($request->statut === 'livre') {
            // Vérifier le code de confirmation
            if ($request->code_confirmation !== $colis->code_confirmation) {
                return response()->json(['message' => 'Code de confirmation incorrect'], 400);
            }
            // Libérer le livreur
            if ($colis->livreur_id) {
                Livreur::where('id', $colis->livreur_id)->update(['disponible' => true]);
            }
        }

        $colis->update(['statut' => $request->statut]);

        return response()->json([
            'message' => 'Statut mis à jour',
            'colis' => $colis,
        ]);
    }
}