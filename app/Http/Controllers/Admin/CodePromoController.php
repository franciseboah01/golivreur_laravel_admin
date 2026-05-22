<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CodePromo;
use Illuminate\Http\Request;

class CodePromoController extends Controller
{
    public function index()
    {
        $codes = CodePromo::orderBy('created_at', 'desc')->get();
        return view('admin.codes-promo.index', compact('codes'));
    }

    public function create()
    {
        return view('admin.codes-promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:codes_promo,code',
            'type' => 'required|in:pourcentage,montant_fixe,livraison_gratuite',
            'valeur' => 'required|numeric|min:0',
            'montant_min' => 'nullable|numeric|min:0',
            'max_utilisation' => 'nullable|integer|min:1',
            'expire_le' => 'nullable|date',
        ]);

        CodePromo::create($request->all());
        return redirect()->route('admin.codes-promo.index')->with('success', 'Code promo créé');
    }

    public function edit($id)
    {
        $code = CodePromo::findOrFail($id);
        return view('admin.codes-promo.edit', compact('code'));
    }

    public function update(Request $request, $id)
    {
        $code = CodePromo::findOrFail($id);
        $code->update($request->only('code', 'type', 'valeur', 'montant_min', 'max_utilisation', 'expire_le', 'actif'));
        return redirect()->route('admin.codes-promo.index')->with('success', 'Code promo mis à jour');
    }

    public function destroy($id)
    {
        CodePromo::findOrFail($id)->delete();
        return back()->with('success', 'Code promo supprimé');
    }
}