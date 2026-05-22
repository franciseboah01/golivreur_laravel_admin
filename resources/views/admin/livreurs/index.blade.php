@extends('admin.layouts.app')
@section('title', 'Livreurs - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">🛵 Livreurs</h1>
            <p class="text-[#8A8A8A] mt-1">Liste de tous les livreurs</p>
        </div>
        <a href="{{ route('admin.livreurs.attente') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">
            ⏳ En attente de validation
        </a>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">Nom</th>
                        <th class="p-4 text-left">Véhicule</th>
                        <th class="p-4 text-left">Zone</th>
                        <th class="p-4 text-left">Disponible</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($livreurs as $l)
                    <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                        <td class="p-4 text-white">{{ $l->id }}</td>
                        <td class="p-4 text-white font-medium">{{ $l->user->nom ?? '' }} {{ $l->user->prenom ?? '' }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $l->vehicule_type ?? '-' }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $l->zone_couverture ?? '-' }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $l->disponible ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                                {{ $l->disponible ? '🟢 En ligne' : '🔴 Hors ligne' }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $l->statut === 'actif' ? 'bg-green-500/10 text-green-500' : ($l->statut === 'en_attente' ? 'bg-yellow-500/10 text-yellow-500' : 'bg-red-500/10 text-red-500') }}">
                                {{ $l->statut }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.clients.edit', $l->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">✏️</a>
                                <a href="{{ route('admin.livreurs.show', $l->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs">👁️</a>
                                @if($l->statut === 'en_attente')
                                <form method="POST" action="{{ route('admin.livreurs.valider', $l->id) }}">
                                    @csrf @method('PUT')
                                    <button class="bg-green-500/10 hover:bg-green-500/20 text-green-500 px-3 py-1 rounded-lg text-xs font-bold">✅</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="p-8 text-center text-[#8A8A8A]">Aucun livreur</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#2D2D2D]">
            {{ $livreurs->links() }}
        </div>
    </div>
</div>
@endsection