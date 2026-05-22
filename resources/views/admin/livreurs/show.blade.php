@extends('admin.layouts.app')
@section('title', 'Détail Livreur - GoLivreur Admin')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.livreurs.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">🛵 {{ $livreur->user->nom ?? '' }} {{ $livreur->user->prenom ?? '' }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📋 Informations</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Nom complet</span>
                    <span class="text-white font-medium">{{ $livreur->user->nom ?? '' }} {{ $livreur->user->prenom ?? '' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Téléphone</span>
                    <span class="text-white">{{ $livreur->user->telephone ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Véhicule</span>
                    <span class="text-white">{{ $livreur->vehicule_type ?? '-' }} {{ $livreur->vehicule_immatriculation ? '(' . $livreur->vehicule_immatriculation . ')' : '' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Zone</span>
                    <span class="text-white">{{ $livreur->zone_couverture ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Disponible</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $livreur->disponible ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                        {{ $livreur->disponible ? '🟢 En ligne' : '🔴 Hors ligne' }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Statut</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $livreur->statut === 'actif' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                        {{ $livreur->statut }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Inscrit le</span>
                    <span class="text-white text-sm">{{ $livreur->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📍 Position</h2>
            @if($livreur->latitude_actuelle && $livreur->longitude_actuelle)
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-[#8A8A8A]">Latitude</span>
                        <span class="text-white">{{ $livreur->latitude_actuelle }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#8A8A8A]">Longitude</span>
                        <span class="text-white">{{ $livreur->longitude_actuelle }}</span>
                    </div>
                </div>
            @else
                <p class="text-[#8A8A8A]">Position non disponible</p>
            @endif
        </div>
    </div>
</div>
@endsection