@extends('admin.layouts.app')
@section('title', 'Colis #' . $colis->id)

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.colis.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">Colis #{{ $colis->id }}</h1>
        <span class="px-3 py-1 rounded-full text-xs font-bold
            {{ $colis->statut === 'en_attente' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
            {{ $colis->statut === 'livre' ? 'bg-green-500/10 text-green-500' : '' }}
            {{ in_array($colis->statut, ['accepte', 'ramasse', 'en_livraison']) ? 'bg-orange-500/10 text-orange-500' : '' }}">
            {{ $colis->statut }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📋 Détails</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Expéditeur</span><span class="text-white">{{ $colis->expediteur->nom ?? '' }} {{ $colis->expediteur->prenom ?? '' }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Destinataire</span><span class="text-white">{{ $colis->destinataire_nom }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Tél destinataire</span><span class="text-white">{{ $colis->destinataire_telephone }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Ramassage</span><span class="text-white">{{ $colis->adresse_ramassage }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Livraison</span><span class="text-white">{{ $colis->adresse_livraison }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Taille</span><span class="text-white">{{ $colis->taille }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Poids</span><span class="text-white">{{ $colis->poids ?? '-' }} kg</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Prix</span><span class="text-[#FF6B00] font-bold">{{ $colis->prix_livraison }} FCFA</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Code</span><span class="text-white font-bold">{{ $colis->code_confirmation }}</span></div>
                <div class="flex justify-between"><span class="text-[#8A8A8A]">Livreur</span><span class="text-white">{{ $colis->livreur->user->nom ?? 'Non assigné' }}</span></div>
            </div>
        </div>

        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📝 Description</h2>
            <p class="text-[#8A8A8A]">{{ $colis->description ?? 'Aucune description' }}</p>
        </div>
    </div>
</div>
@endsection