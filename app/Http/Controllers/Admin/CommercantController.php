<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commercant;
use Illuminate\Http\Request;

class CommercantController extends Controller
{
    public function index(Request $request)
    {
        $query = Commercant::with('user');

        if ($request->zone_id) {
            $query->where('zone_id', $request->zone_id);
        } elseif (auth('admin')->user()->zone_id) {
            $query->where('zone_id', auth('admin')->user()->zone_id);
        }

        $commercants = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.commercants.index', compact('commercants'));
    }

    public function enAttente()
    {
        $commercants = Commercant::with('user')->where('statut', 'en_attente')->paginate(20);
        return view('admin.commercants.attente', compact('commercants'));
    }

    public function show($id)
    {
        $commercant = Commercant::with('user', 'produits')->findOrFail($id);
        return view('admin.commercants.show', compact('commercant'));
    }

    public function valider($id)
    {
        Commercant::findOrFail($id)->update(['statut' => 'actif']);
        return back()->with('success', 'Commerçant validé');
    }

    public function toggle($id)
    {
        $c = Commercant::findOrFail($id);
        $c->update(['statut' => $c->statut === 'actif' ? 'inactif' : 'actif']);
        return back()->with('success', 'Statut modifié');
    }

    public function edit($id)
    {
        $commercant = Commercant::findOrFail($id);
        return view('admin.commercants.edit', compact('commercant'));
    }

    public function update(Request $request, $id)
    {
        $commercant = Commercant::findOrFail($id);
        $commercant->update($request->only('nom_boutique', 'categorie', 'adresse', 'telephone_boutique'));
        return redirect()->route('admin.commercants.index')->with('success', 'Commerçant mis à jour');
    }
}