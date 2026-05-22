<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function envoyer(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:100',
            'message' => 'required|string',
        ]);

        // Envoyer à tous les utilisateurs
        $users = \App\Models\User::where('statut', true)->get();
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'titre' => $request->titre,
                'message' => $request->message,
                'type' => 'systeme',
            ]);
        }

        return back()->with('success', 'Notification envoyée à ' . $users->count() . ' utilisateurs');
    }
}