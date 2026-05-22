<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\RoleAdmin;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::orderBy('created_at', 'desc');

        if (auth('admin')->user()->zone_id) {
            $query->where('zone_id', auth('admin')->user()->zone_id);
        }

        $admins = $query->paginate(20);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = RoleAdmin::where('actif', true)->orderBy('nom')->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:admins',
            'telephone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8',
            'role_admin_id' => 'required|exists:roles_admin,id',
        ]);

        // Si Super Admin crée → valide, sinon → en attente
        $statut = auth('admin')->user()->hasPermission('admins') ? 'valide' : 'en_attente';

        Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password,
            'role_admin_id' => $request->role_admin_id,
            'zone_id' => $request->zone_id ?? auth('admin')->user()->zone_id,
            'created_by' => auth('admin')->id(),
            'statut_validation' => $statut,
            'actif' => $statut === 'valide',
        ]);

        $message = $statut === 'valide'
            ? 'Administrateur créé avec succès'
            : 'Administrateur créé, en attente de validation par le Super Admin';

        return redirect()->route('admin.admins.index')->with('success', $message);
    }

    public function enAttente()
    {
        if (!auth('admin')->user()->hasPermission('admins')) abort(403);
        $admins = Admin::where('statut_validation', 'en_attente')->paginate(20);
        return view('admin.admins.attente', compact('admins'));
    }

    public function valider($id)
    {
        if (!auth('admin')->user()->hasPermission('admins')) abort(403);
        Admin::findOrFail($id)->update(['statut_validation' => 'valide', 'actif' => true]);
        return back()->with('success', 'Administrateur validé');
    }

    public function rejeter($id)
    {
        if (!auth('admin')->user()->hasPermission('admins')) abort(403);
        Admin::findOrFail($id)->update(['statut_validation' => 'rejete', 'actif' => false]);
        return back()->with('success', 'Administrateur rejeté');
    }

    public function toggle($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update(['actif' => !$admin->actif]);
        return back()->with('success', 'Statut modifié');
    }

    public function destroy($id)
    {
        if (!auth('admin')->user()->hasPermission('admins')) abort(403);
        $admin = Admin::findOrFail($id);
        if ($admin->id === auth('admin')->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }
        $admin->delete();
        return back()->with('success', 'Administrateur supprimé');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = RoleAdmin::where('actif', true)->orderBy('nom')->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:admins,email,' . $id,
            'telephone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8',
            'role_admin_id' => 'required|exists:roles_admin,id',
        ]);

        $data = $request->only('nom', 'prenom', 'email', 'telephone', 'role_admin_id', 'zone_id');
        if ($request->password) $data['password'] = $request->password;

        $admin->update($data);
        return redirect()->route('admin.admins.index')->with('success', 'Administrateur mis à jour');
    }

    public function show($id)
    {
        $admin = Admin::with('roleAdmin', 'createur')->findOrFail($id);
        return view('admin.admins.show', compact('admin'));
    }
}