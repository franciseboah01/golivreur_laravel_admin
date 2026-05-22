<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::orderBy('nom')->paginate(20);
        return view('admin.zones.index', compact('zones'));
    }

    public function create()
    {
        return view('admin.zones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:zones',
            'code' => 'nullable|string|max:10',
            'frais_livraison_base' => 'numeric|min:0',
            'frais_livraison_km' => 'numeric|min:0',
            'rayon_km' => 'integer|min:1',
        ]);

        Zone::create($request->all());
        return redirect()->route('admin.zones.index')->with('success', 'Zone créée');
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        return view('admin.zones.edit', compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $zone = Zone::findOrFail($id);
        $zone->update($request->only('nom', 'code', 'frais_livraison_base', 'frais_livraison_km', 'rayon_km', 'latitude', 'longitude', 'actif'));
        return redirect()->route('admin.zones.index')->with('success', 'Zone mise à jour');
    }

    public function destroy($id)
    {
        Zone::findOrFail($id)->delete();
        return back()->with('success', 'Zone supprimée');
    }
}