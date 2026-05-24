<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;


class ExportController extends Controller
{
    public function index()
    {
        return view('admin.exports.index');
    }

    public function commandes()
    {
        $commandes = Commande::with('client', 'commercant', 'livreur.user')->orderBy('created_at', 'desc')->get();
        return view('admin.exports.commandes', compact('commandes'));
    }

    public function transactions()
    {
        return view('admin.exports.transactions');
    }

    public function utilisateurs()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.exports.utilisateurs', compact('users'));
    }

    public function colis()
    {
        $colis = \App\Models\Colis::with('expediteur', 'livreur.user')->orderBy('created_at', 'desc')->get();
        return view('admin.exports.colis', compact('colis'));
    }

    public function livreurs()
    {
        $livreurs = \App\Models\Livreur::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.exports.livreurs', compact('livreurs'));
    }

    public function commercants()
    {
        $commercants = \App\Models\Commercant::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.exports.commercants', compact('commercants'));
    }
}