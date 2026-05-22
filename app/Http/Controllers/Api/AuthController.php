<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function inscrire(Request $request)
    {
        $validateur = Validator::make($request->all(), [
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'telephone' => 'required|string|max:15|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:client,livreur,commercant',
            'zone_id' => 'nullable|exists:zones,id',
        ]);

        if ($validateur->fails()) {
            return response()->json(['erreur' => $validateur->errors()], 422);
        }

        $utilisateur = User::create($request->all());

        $token = $utilisateur->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'utilisateur' => $utilisateur,
            'token' => $token,
        ], 201);
    }

    public function connecter(Request $request)
    {
        $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string',
        ]);

        $utilisateur = User::where('telephone', $request->telephone)->first();

        if (!$utilisateur || !Hash::check($request->password, $utilisateur->password)) {
            return response()->json(['message' => 'Téléphone ou mot de passe incorrect'], 401);
        }

        $token = $utilisateur->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'utilisateur' => $utilisateur,
            'token' => $token,
        ]);
    }

    public function profil(Request $request)
    {
        $user = $request->user();
        $data = $user->toArray();

        if ($user->role === 'commercant') {
            $data['commercant'] = $user->commercant;
        }

        return response()->json($data);
    }

    public function updateProfil(Request $request)
    {
        $request->user()->update($request->only('adresse', 'ville', 'quartier'));
        return response()->json(['message' => 'OK', 'user' => $request->user()]);
    }

    public function deconnecter(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}