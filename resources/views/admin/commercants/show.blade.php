@extends('admin.layouts.app')
@section('title', 'Détail Commerçant - GoLivreur Admin')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.commercants.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">🏪 {{ $commercant->nom_boutique }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📋 Informations</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Boutique</span>
                    <span class="text-white font-medium">{{ $commercant->nom_boutique }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Propriétaire</span>
                    <span class="text-white">{{ $commercant->user->nom ?? '' }} {{ $commercant->user->prenom ?? '' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Catégorie</span>
                    <span class="text-white">{{ $commercant->categorie ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Adresse</span>
                    <span class="text-white">{{ $commercant->adresse }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Téléphone</span>
                    <span class="text-white">{{ $commercant->telephone_boutique ?? $commercant->user->telephone ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Horaires</span>
                    <span class="text-white">{{ $commercant->horaires ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Statut</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $commercant->statut === 'actif' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                        {{ $commercant->statut }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📦 Produits ({{ $commercant->produits->count() }})</h2>
            @if($commercant->produits->count() > 0)
                <div class="space-y-2">
                    @foreach($commercant->produits as $p)
                    <div class="flex justify-between bg-[#1E1E1E] p-3 rounded-xl">
                        <span class="text-white">{{ $p->nom }}</span>
                        <span class="text-[#FF6B00] font-bold">{{ $p->prix }} FCFA</span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-[#8A8A8A]">Aucun produit</p>
            @endif
        </div>
    </div>
</div>
@endsection