@extends('admin.layouts.app')
@section('title', 'Détail Client - GoLivreur Admin')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.clients.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">👤 {{ $client->nom }} {{ $client->prenom }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📋 Informations</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Nom complet</span>
                    <span class="text-white font-medium">{{ $client->nom }} {{ $client->prenom }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Téléphone</span>
                    <span class="text-white">{{ $client->telephone }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Email</span>
                    <span class="text-white">{{ $client->email ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Statut</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $client->statut ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                        {{ $client->statut ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#8A8A8A]">Inscrit le</span>
                    <span class="text-white text-sm">{{ $client->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">🛒 Commandes</h2>
            @if($client->commandes->count() > 0)
                <div class="space-y-2">
                    @foreach($client->commandes as $cmd)
                    <div class="flex justify-between bg-[#1E1E1E] p-3 rounded-xl">
                        <span class="text-white">#{{ $cmd->id }}</span>
                        <span class="text-[#FF6B00] font-bold">{{ $cmd->total }} FCFA</span>
                        <span class="px-2 py-0.5 rounded-full text-xs {{ $cmd->statut === 'livree' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">{{ $cmd->statut }}</span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-[#8A8A8A]">Aucune commande</p>
            @endif
        </div>
    </div>
</div>
@endsection