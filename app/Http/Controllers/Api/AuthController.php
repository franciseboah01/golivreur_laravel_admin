<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'telephone' => 'required|string|max:15|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:client,livreur,commercant',
            'zone_id' => 'nullable|exists:zones,id',
            'vehicule_type' => 'nullable|in:velo,voiture,tricycle|required_if:role,livreur',
        ]);

        if ($validator->fails()) {
            return response()->json(['erreur' => $validator->errors()], 422);
        }

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['telephone'] = preg_replace('/\s+/', '', $data['telephone']);

        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'utilisateur' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $telephone = preg_replace('/\s+/', '', $request->telephone);
        $user = User::where('telephone', $telephone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'utilisateur' => $user,
            'token' => $token,
        ], 200);
    }

    public function profile(Request $request)
    {
        $user = $request->user()->load(['commercant', 'livreur']);
        return response()->json($user);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'nom' => 'sometimes|string|max:50',
            'prenom' => 'sometimes|string|max:50',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'adresse' => 'sometimes|string',
            'ville' => 'sometimes|string',
            'quartier' => 'sometimes|string',
        ]);

        $user->update($data);
        return response()->json(['message' => 'Profil mis à jour', 'utilisateur' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
