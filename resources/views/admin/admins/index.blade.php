@extends('admin.layouts.app')
@section('title', 'Administrateurs - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">👑 Administrateurs</h1>
            <p class="text-[#8A8A8A] mt-1">Gestion des comptes administrateurs</p>
        </div>
        <a href="{{ route('admin.admins.create') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">
            + Créer un admin
        </a>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">Nom</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Zone</th>
                        <th class="p-4 text-left">Rôle</th>
                        <th class="p-4 text-left">Validation</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Dernière connexion</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                        <td class="p-4 text-white">{{ $admin->id }}</td>
                        <td class="p-4 text-white font-medium">{{ $admin->nom }} {{ $admin->prenom }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $admin->email }}</td>
                        <td class="p-4 text-white">
                            {{ $admin->zone->nom ?? 'Toutes' }}
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#FF6B00]/10 text-[#FF6B00]">
                                {{ $admin->roleAdmin->nom ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($admin->statut_validation === 'en_attente')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-500">En attente</span>
                                @if(auth('admin')->user()->hasPermission('admins'))
                                    <div class="flex gap-1 mt-1">
                                        <form method="POST" action="{{ route('admin.admins.valider', $admin->id) }}">
                                            @csrf @method('PUT')
                                            <button class="bg-green-500/10 hover:bg-green-500/20 text-green-500 px-2 py-0.5 rounded text-xs">✅</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.admins.rejeter', $admin->id) }}">
                                            @csrf @method('PUT')
                                            <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-2 py-0.5 rounded text-xs">❌</button>
                                        </form>
                                    </div>
                                @endif
                            @elseif($admin->statut_validation === 'rejete')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/10 text-red-500">Rejeté</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-500">Validé</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $admin->actif ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                                {{ $admin->actif ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="p-4 text-[#8A8A8A] text-xs">
                            {{ $admin->last_login ? $admin->last_login->diffForHumans() : 'Jamais' }}
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.admins.show', $admin->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">👁️</a>
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">✏️</a>
                                <form method="POST" action="{{ route('admin.admins.toggle', $admin->id) }}">
                                    @csrf @method('PUT')
                                    <button class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">
                                        {{ $admin->actif ? '🔒' : '🔓' }}
                                    </button>
                                </form>
                                @if(auth('admin')->user()->hasPermission('admins') && $admin->id !== auth('admin')->id())
                                <form method="POST" action="{{ route('admin.admins.destroy', $admin->id) }}" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-3 py-1 rounded-lg text-xs transition">🗑️</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="p-8 text-center text-[#8A8A8A]">Aucun administrateur</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#2D2D2D]">
            {{ $admins->links() }}
        </div>
    </div>
</div>
@endsection