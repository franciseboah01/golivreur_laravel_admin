@extends('admin.layouts.app')
@section('title', 'Commande #' . $commande->id)

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.commandes.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">Commande #{{ $commande->id }}</h1>
        <span class="px-3 py-1 rounded-full text-xs font-bold
            {{ $commande->statut === 'en_attente' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
            {{ $commande->statut === 'acceptee' ? 'bg-blue-500/10 text-blue-500' : '' }}
            {{ $commande->statut === 'en_livraison' ? 'bg-orange-500/10 text-orange-500' : '' }}
            {{ $commande->statut === 'livree' ? 'bg-green-500/10 text-green-500' : '' }}
            {{ $commande->statut === 'annulee' ? 'bg-red-500/10 text-red-500' : '' }}">
            {{ $commande->statut }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Infos -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-[#121212] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">📦 Produits</h2>
                @foreach($commande->produits as $p)
                <div class="flex justify-between py-2 border-b border-[#2D2D2D]">
                    <span class="text-white">{{ $p->nom }}</span>
                    <span class="text-[#8A8A8A]">{{ $p->pivot->quantite }} x {{ $p->pivot->prix_unitaire }} FCFA</span>
                </div>
                @endforeach
                <div class="flex justify-between mt-4 pt-4 border-t border-[#2D2D2D]">
                    <span class="text-white font-bold">Total</span>
                    <span class="text-[#FF6B00] font-bold text-xl">{{ $commande->total }} FCFA</span>
                </div>
            </div>

            <!-- Changer statut -->
            <div class="bg-[#121212] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">🔄 Changer statut</h2>
                <form method="POST" action="{{ route('admin.commandes.statut', $commande->id) }}" class="flex flex-wrap gap-2">
                    @csrf @method('PUT')
                    @foreach(['en_attente', 'acceptee', 'en_livraison', 'livree', 'annulee'] as $s)
                    <button name="statut" value="{{ $s }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ $commande->statut === $s ? 'bg-[#FF6B00] text-white' : 'bg-[#1E1E1E] text-[#8A8A8A] hover:bg-[#2D2D2D]' }}">{{ str_replace('_', ' ', ucfirst($s)) }}</button>
                    @endforeach
                </form>
            </div>
        </div>

        <!-- Détails + Attribution -->
        <div class="space-y-6">
            <div class="bg-[#121212] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">📋 Détails</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Client</span><span class="text-white">{{ $commande->client->nom ?? '' }} {{ $commande->client->prenom ?? '' }}</span></div>
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Téléphone</span><span class="text-white">{{ $commande->client->telephone ?? '-' }}</span></div>
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Boutique</span><span class="text-white">{{ $commande->commercant->nom_boutique ?? '-' }}</span></div>
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Adresse</span><span class="text-white">{{ $commande->adresse_livraison }}</span></div>
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Paiement</span><span class="text-white">{{ $commande->mode_paiement }}</span></div>
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Livraison</span><span class="text-white">{{ $commande->frais_livraison }} FCFA</span></div>
                    <div class="flex justify-between"><span class="text-[#8A8A8A]">Code</span><span class="text-white font-bold">{{ $commande->code_confirmation }}</span></div>
                </div>
            </div>

            <!-- Attribution livreur -->
            <div class="bg-[#121212] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">🛵 Livreur</h2>
                @if($commande->livreur)
                    <p class="text-white mb-3">{{ $commande->livreur->user->nom ?? '' }} {{ $commande->livreur->user->prenom ?? '' }}</p>
                @endif
                <form method="POST" action="{{ route('admin.commandes.attribuer', $commande->id) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <select name="livreur_id" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
                        <option value="">Choisir un livreur</option>
                        @foreach($livreurs as $l)
                        <option value="{{ $l->id }}" class="bg-[#1E1E1E]">{{ $l->user->nom ?? '' }} {{ $l->user->prenom ?? '' }} ({{ $l->vehicule_type }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-2 rounded-xl text-sm">Attribuer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection