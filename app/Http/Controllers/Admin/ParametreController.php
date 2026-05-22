<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        $parametres = Parametre::orderBy('groupe')->get()->groupBy('groupe');
        return view('admin.parametres.index', compact('parametres'));
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $cle => $valeur) {
            if ($cle !== '_token') {
                Parametre::updateOrCreate(['cle' => $cle], ['valeur' => $valeur]);
            }
        }
        return back()->with('success', 'Paramètres mis à jour');
    }
}