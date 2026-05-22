<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commercant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommercantController extends Controller
{
    // Statut du commerçant connecté
    public function statut(Request $request)
    {
        $utilisateur = $request->user();

        if ($utilisateur->role !== 'commercant') {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        return response()->json([
            'user' => $utilisateur,
            'commercant' => $commercant,
            'profil_complet' => $commercant ? true : false,
            'statut' => $commercant ? $commercant->statut : 'non_configurer',
        ]);
    }

    // Créer ou mettre à jour le profil commerçant
    public function profil(Request $request)
    {
        $utilisateur = $request->user();

        if ($utilisateur->role !== 'commercant') {
            return response()->json(['message' => 'Accès refusé. Vous devez être commerçant.'], 403);
        }

        $validateur = Validator::make($request->all(), [
            'nom_boutique' => 'required|string|max:100',
            'description' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'telephone_boutique' => 'nullable|string|max:15',
            'photo_boutique' => 'nullable|string',
            'categorie' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'horaires' => 'nullable|string|max:150',
            'ouvert' => 'nullable|boolean',
        ]);

        if ($validateur->fails()) {
            return response()->json(['erreur' => $validateur->errors()], 422);
        }

        $commercant = Commercant::updateOrCreate(
            ['user_id' => $utilisateur->id],
            $request->all()
        );

        return response()->json([
            'message' => 'Profil commerçant mis à jour',
            'commercant' => $commercant,
        ]);
    }

    // Voir son profil commerçant
    public function voir(Request $request)
    {
        $utilisateur = $request->user();
        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        if (!$commercant) {
            return response()->json(['message' => 'Profil commerçant non trouvé'], 404);
        }

        return response()->json($commercant);
    }

    // Liste des commerçants (pour les clients) – filtré par zone
    public function liste(Request $request)
    {
        $query = Commercant::with('user:id,nom,prenom,telephone')
            ->where('statut', 'actif')
            ->where('ouvert', true);

        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        }

        return response()->json($query->get());
    }

    // Voir un commerçant spécifique
    public function detail($id)
    {
        $commercant = Commercant::with('user:id,nom,prenom,telephone')->find($id);

        if (!$commercant) {
            return response()->json(['message' => 'Commerçant non trouvé'], 404);
        }

        return response()->json($commercant);
    }

    // Recherche commerçants
    public function recherche(Request $request)
    {
        $query = Commercant::with('user:id,nom,prenom,telephone')
            ->where('statut', 'actif');

        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        }

        if ($request->filled('q')) {
            $terme = '%' . $request->q . '%';
            $query->where(function ($q) use ($terme) {
                $q->where('nom_boutique', 'like', $terme)
                  ->orWhere('categorie', 'like', $terme)
                  ->orWhere('adresse', 'like', $terme)
                  ->orWhere('description', 'like', $terme);
            });
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', 'like', '%' . $request->categorie . '%');
        }
        if ($request->filled('nom')) {
            $query->where('nom_boutique', 'like', '%' . $request->nom . '%');
        }

        return response()->json($query->get());
    }
}