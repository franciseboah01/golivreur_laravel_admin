@extends('admin.layouts.app')
@section('title', 'Détail Administrateur - GoLivreur Admin')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.admins.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">👤 {{ $admin->nom }} {{ $admin->prenom }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Infos -->
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📋 Informations</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Nom complet</span>
                    <span class="text-white font-medium">{{ $admin->nom }} {{ $admin->prenom }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Email</span>
                    <span class="text-white">{{ $admin->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Téléphone</span>
                    <span class="text-white">{{ $admin->telephone ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Zone</span>
                    <span class="text-white">{{ $admin->zone->nom ?? 'Toutes les villes' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Rôle</span>
                    <span class="bg-[#FF6B00]/10 text-[#FF6B00] px-3 py-1 rounded-full text-xs font-bold">{{ $admin->roleAdmin->nom ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Validation</span>
                    @if($admin->statut_validation === 'en_attente')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-500">En attente</span>
                    @elseif($admin->statut_validation === 'rejete')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/10 text-red-500">Rejeté</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-500">Validé</span>
                    @endif
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Statut</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $admin->actif ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                        {{ $admin->actif ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Créé par</span>
                    <span class="text-white">{{ $admin->createur ? $admin->createur->nom . ' ' . $admin->createur->prenom : 'Système' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Dernière connexion</span>
                    <span class="text-white text-sm">{{ $admin->last_login ? $admin->last_login->format('d/m/Y H:i') : 'Jamais' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Créé le</span>
                    <span class="text-white text-sm">{{ $admin->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Permissions -->
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">🔑 Permissions</h2>
            @php $perms = $admin->roleAdmin->permissions ?? []; @endphp
            @if(in_array('*', $perms))
                <span class="bg-[#FF6B00] text-white px-3 py-1 rounded-full text-xs font-bold">Tous les droits (Super Admin)</span>
            @else
                <div class="flex flex-wrap gap-2">
                    @foreach($perms as $p)
                        <span class="bg-[#1E1E1E] text-[#8A8A8A] px-3 py-1 rounded-full text-xs">{{ $p }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex gap-3">
        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">✏️ Modifier</a>
        <form method="POST" action="{{ route('admin.admins.toggle', $admin->id) }}">
            @csrf @method('PUT')
            <button class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-white px-4 py-2 rounded-xl text-sm transition">
                {{ $admin->actif ? '🔒 Désactiver' : '🔓 Activer' }}
            </button>
        </form>
        @if($admin->statut_validation === 'en_attente' && auth('admin')->user()->hasPermission('admins'))
            <form method="POST" action="{{ route('admin.admins.valider', $admin->id) }}">
                @csrf @method('PUT')
                <button class="bg-green-500/10 hover:bg-green-500/20 text-green-500 px-4 py-2 rounded-xl text-sm transition">✅ Valider</button>
            </form>
            <form method="POST" action="{{ route('admin.admins.rejeter', $admin->id) }}">
                @csrf @method('PUT')
                <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-4 py-2 rounded-xl text-sm transition">❌ Rejeter</button>
            </form>
        @endif
        @if(auth('admin')->user()->hasPermission('admins') && $admin->id !== auth('admin')->id())
        <form method="POST" action="{{ route('admin.admins.destroy', $admin->id) }}" onsubmit="return confirm('Supprimer ?')">
            @csrf @method('DELETE')
            <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-4 py-2 rounded-xl text-sm transition">🗑️ Supprimer</button>
        </form>
        @endif
    </div>
</div>
@endsection