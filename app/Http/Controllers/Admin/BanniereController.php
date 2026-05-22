<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanniereController extends Controller
{
    public function index()
    {
        $bannieres = [];
        return view('admin.bannieres.index', compact('bannieres'));
    }

    public function create()
    {
        return view('admin.bannieres.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.bannieres.index')->with('success', 'Bannière créée');
    }

    public function edit($id)
    {
        return view('admin.bannieres.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.bannieres.index')->with('success', 'Bannière mise à jour');
    }

    public function destroy($id)
    {
        return back()->with('success', 'Bannière supprimée');
    }
}