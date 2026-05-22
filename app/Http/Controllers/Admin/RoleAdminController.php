<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleAdmin;
use Illuminate\Http\Request;

class RoleAdminController extends Controller
{
    public static $allPermissions = [
        'dashboard' => 'Dashboard',
        'clients' => 'Gestion clients',
        'commercants' => 'Gestion commerçants',
        'livreurs' => 'Gestion livreurs',
        'commandes' => 'Gestion commandes',
        'colis' => 'Gestion colis',
        'categories' => 'Gestion catégories',
        'codes_promo' => 'Gestion codes promo',
        'parametres' => 'Paramètres plateforme',
        'transactions' => 'Transactions & Retraits',
        'avis' => 'Modération avis',
        'signalements' => 'Traitement signalements',
        'notifications' => 'Envoi notifications',
        'zones' => 'Gestion zones',
        'bannieres' => 'Gestion bannières',
        'exports' => 'Exports données',
        'logs' => 'Consultation logs',
        'admins' => 'Gestion administrateurs',
        'roles' => 'Gestion rôles',
        'analytics' => 'Analyses & Statistiques',
        'comptabilite' => 'Comptabilité & Finance',
        'marketing' => 'Marketing & Promotions',
        'support' => 'Support client',
    ];

    public function index()
    {
        $roles = RoleAdmin::orderBy('nom')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = self::$allPermissions;
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50|unique:roles_admin',
            'description' => 'nullable|string|max:255',
        ]);

        RoleAdmin::create([
            'nom' => $request->nom,
            'permissions' => $request->permissions ?? [],
            'description' => $request->description,
            'actif' => true,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Rôle créé');
    }

    public function edit($id)
    {
        $role = RoleAdmin::findOrFail($id);
        $permissions = self::$allPermissions;
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = RoleAdmin::findOrFail($id);
        $role->update([
            'nom' => $request->nom,
            'permissions' => $request->permissions ?? [],
            'description' => $request->description,
            'actif' => $request->has('actif'),
        ]);
        return redirect()->route('admin.roles.index')->with('success', 'Rôle mis à jour');
    }

    public function destroy($id)
    {
        RoleAdmin::findOrFail($id)->delete();
        return back()->with('success', 'Rôle supprimé');
    }
}