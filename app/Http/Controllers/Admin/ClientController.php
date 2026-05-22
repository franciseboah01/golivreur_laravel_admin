<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'client')->withCount('commandes');

        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        } elseif (auth('admin')->user()->zone_id) {
            $query->where('zone_id', auth('admin')->user()->zone_id);
        }

        $clients = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.clients.index', compact('clients'));
    }

    public function show($id)
    {
        $client = User::with('commandes')->findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }

    public function toggle($id)
    {
        $client = User::findOrFail($id);
        $client->update(['statut' => !$client->statut]);
        return back()->with('success', 'Statut modifié');
    }

    public function edit($id)
    {
        $client = User::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = User::findOrFail($id);
        $client->update($request->only('nom', 'prenom', 'telephone', 'email'));
        return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour');
    }
}