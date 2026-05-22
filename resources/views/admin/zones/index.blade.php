@extends('admin.layouts.app')
@section('title', 'Zones - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">📍 Zones</h1>
            <p class="text-[#8A8A8A] mt-1">Gestion des villes et tarifs de livraison</p>
        </div>
        <a href="{{ route('admin.zones.create') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">
            + Nouvelle ville
        </a>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Ville</th>
                    <th class="p-4 text-left">Code</th>
                    <th class="p-4 text-left">Rayon</th>
                    <th class="p-4 text-left">Livraison base</th>
                    <th class="p-4 text-left">Par km</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($zones as $zone)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                    <td class="p-4 text-white">{{ $zone->id }}</td>
                    <td class="p-4 text-white font-medium">{{ $zone->nom }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $zone->code ?? '-' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $zone->rayon_km }} km</td>
                    <td class="p-4 text-[#FF6B00] font-bold">{{ number_format($zone->frais_livraison_base, 0, ',', ' ') }} FCFA</td>
                    <td class="p-4 text-[#8A8A8A]">{{ number_format($zone->frais_livraison_km, 0, ',', ' ') }} FCFA/km</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $zone->actif ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                            {{ $zone->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.zones.edit', $zone->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">✏️</a>
                            <form method="POST" action="{{ route('admin.zones.destroy', $zone->id) }}" onsubmit="return confirm('Supprimer cette zone ?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-3 py-1 rounded-lg text-xs transition">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="p-8 text-center text-[#8A8A8A]">Aucune zone</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#2D2D2D]">{{ $zones->links() }}</div>
    </div>
</div>
@endsection