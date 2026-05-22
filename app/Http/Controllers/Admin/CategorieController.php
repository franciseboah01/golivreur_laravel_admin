<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::orderBy('ordre')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'icone' => 'nullable|string|max:10',
            'image' => 'nullable|string',
        ]);

        Categorie::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée');
    }

    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categories.edit', compact('categorie'));
    }

    public function update(Request $request, $id)
    {
        Categorie::findOrFail($id)->update($request->only('nom', 'icone', 'image', 'actif', 'ordre'));
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour');
    }

    public function destroy($id)
    {
        Categorie::findOrFail($id)->delete();
        return back()->with('success', 'Catégorie supprimée');
    }
}