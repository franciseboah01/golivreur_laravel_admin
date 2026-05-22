<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function envoyer(Request $request) {
    $msg = Message::create([
        'commande_id' => $request->commande_id,
        'colis_id' => $request->colis_id,
        'expediteur_id' => $request->user()->id,
        'destinataire_id' => $request->destinataire_id,
        'contenu' => $request->contenu,
    ]);
    return response()->json($msg, 201);
}

    public function conversation(Request $request) {
        $userId = $request->user()->id;
        $msgs = Message::where(function($q) use ($userId, $request) {
            $q->where('expediteur_id', $userId)->where('destinataire_id', $request->autre_id);
        })->orWhere(function($q) use ($userId, $request) {
            $q->where('expediteur_id', $request->autre_id)->where('destinataire_id', $userId);
        })->orderBy('created_at')->get();
        return response()->json($msgs);
    }
}