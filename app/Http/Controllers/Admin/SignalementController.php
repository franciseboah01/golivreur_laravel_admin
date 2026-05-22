<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function index()
    {
        $signalements = []; // À connecter à une table signalements
        return view('admin.signalements.index', compact('signalements'));
    }

    public function traiter(Request $request, $id)
    {
        return back()->with('success', 'Signalement traité');
    }
}