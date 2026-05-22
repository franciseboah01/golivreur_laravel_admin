<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commercant;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    // Ajouter un produit
    public function ajouter(Request $request)
    {
        $utilisateur = $request->user();
        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        if (!$commercant) {
            return response()->json(['message' => 'Profil commerçant non trouvé'], 404);
        }

        $validateur = Validator::make($request->all(), [
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'photo' => 'nullable|string',
            'categorie' => 'nullable|string|max:50',
            'disponible' => 'nullable|boolean',
            'stock' => 'nullable|integer|min:0',
        ]);

        if ($validateur->fails()) {
            return response()->json(['erreur' => $validateur->errors()], 422);
        }

        $produit = Produit::create([
            'commercant_id' => $commercant->id,
            ...$request->all(),
        ]);

        return response()->json([
            'message' => 'Produit ajouté avec succès',
            'produit' => $produit,
        ], 201);
    }

    // Lister ses propres produits (commerçant)
    public function mesProduits(Request $request)
    {
        $utilisateur = $request->user();
        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        if (!$commercant) {
            return response()->json(['message' => 'Profil commerçant non trouvé'], 404);
        }

        $produits = Produit::where('commercant_id', $commercant->id)->get();

        return response()->json($produits);
    }

    // Modifier un produit
    public function modifier(Request $request, $id)
    {
        $utilisateur = $request->user();
        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        if (!$commercant) {
            return response()->json(['message' => 'Profil commerçant non trouvé'], 404);
        }

        $produit = Produit::where('id', $id)->where('commercant_id', $commercant->id)->first();

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->update($request->all());

        return response()->json([
            'message' => 'Produit modifié avec succès',
            'produit' => $produit,
        ]);
    }

    // Supprimer un produit
    public function supprimer(Request $request, $id)
    {
        $utilisateur = $request->user();
        $commercant = Commercant::where('user_id', $utilisateur->id)->first();

        if (!$commercant) {
            return response()->json(['message' => 'Profil commerçant non trouvé'], 404);
        }

        $produit = Produit::where('id', $id)->where('commercant_id', $commercant->id)->first();

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès']);
    }

    // Voir les produits d'un commerçant (public)
    public function produitsCommercant($commercantId)
    {
        $produits = Produit::where('commercant_id', $commercantId)
            ->where('disponible', true)
            ->get();

        return response()->json($produits);
    }
}