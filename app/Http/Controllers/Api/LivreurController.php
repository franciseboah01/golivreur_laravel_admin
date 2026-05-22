<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LivreurController extends Controller
{
    // Créer ou mettre à jour le profil livreur
    public function profil(Request $request)
    {
        $utilisateur = $request->user();

        if ($utilisateur->role !== 'livreur') {
            return response()->json(['message' => 'Accès refusé. Vous devez être livreur.'], 403);
        }

        $validateur = Validator::make($request->all(), [
            'vehicule_type' => 'nullable|string|max:50',
            'vehicule_immatriculation' => 'nullable|string|max:20',
            'photo_vehicule' => 'nullable|string',
            'zone_couverture' => 'nullable|string|max:100',
            'latitude_actuelle' => 'nullable|numeric',
            'longitude_actuelle' => 'nullable|numeric',
        ]);

        if ($validateur->fails()) {
            return response()->json(['erreur' => $validateur->errors()], 422);
        }

        $livreur = Livreur::updateOrCreate(
            ['user_id' => $utilisateur->id],
            $request->all()
        );

        return response()->json([
            'message' => 'Profil livreur mis à jour',
            'livreur' => $livreur,
        ]);
    }

    // Voir son profil livreur
    public function voir(Request $request)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        return response()->json($livreur);
    }

    // Changer la disponibilité
    public function disponibilite(Request $request)
    {
        $utilisateur = $request->user();
        $livreur = Livreur::where('user_id', $utilisateur->id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Profil livreur non trouvé'], 404);
        }

        $request->validate([
            'disponible' => 'required|boolean',
            'latitude_actuelle' => 'nullable|numeric',
            'longitude_actuelle' => 'nullable|numeric',
        ]);

        $livreur->update([
            'disponible' => $request->disponible,
            'latitude_actuelle' => $request->latitude_actuelle ?? $livreur->latitude_actuelle,
            'longitude_actuelle' => $request->longitude_actuelle ?? $livreur->longitude_actuelle,
        ]);

        return response()->json([
            'message' => $request->disponible ? 'Vous êtes maintenant disponible' : 'Vous êtes maintenant indisponible',
            'livreur' => $livreur,
        ]);
    }

    public function updatePosition(Request $request) {
        $livreur = Livreur::where('user_id', $request->user()->id)->first();
        $livreur->update([
            'latitude_actuelle' => $request->latitude,
            'longitude_actuelle' => $request->longitude,
        ]);
        return response()->json(['message' => 'OK']);
    }

    public function getPosition($id) {
        $livreur = Livreur::with('user')->find($id);
        return response()->json([
            'latitude' => $livreur->latitude_actuelle,
            'longitude' => $livreur->longitude_actuelle,
            'nom' => $livreur->user->nom,
        ]);
    }
}