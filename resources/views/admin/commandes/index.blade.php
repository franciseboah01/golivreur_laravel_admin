@extends('admin.layouts.app')
@section('title', 'Commandes - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">🛒 Commandes</h1>
    </div>

    <!-- Filtres -->
    <div class="bg-[#121212] rounded-2xl p-4 mb-6 flex flex-wrap gap-3">
        <a href="{{ route('admin.commandes.index') }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ !request('statut') ? 'bg-[#FF6B00] text-white' : 'bg-[#1E1E1E] text-[#8A8A8A]' }}">Toutes</a>
        @foreach(['en_attente', 'acceptee', 'en_livraison', 'livree', 'annulee'] as $s)
        <a href="{{ route('admin.commandes.index', ['statut' => $s]) }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ request('statut') === $s ? 'bg-[#FF6B00] text-white' : 'bg-[#1E1E1E] text-[#8A8A8A]' }}">{{ str_replace('_', ' ', ucfirst($s)) }}</a>
        @endforeach
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Client</th>
                    <th class="p-4 text-left">Boutique</th>
                    <th class="p-4 text-left">Total</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Livreur</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandes as $cmd)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                    <td class="p-4 text-white">#{{ $cmd->id }}</td>
                    <td class="p-4 text-white">{{ $cmd->client->nom ?? '' }} {{ $cmd->client->prenom ?? '' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $cmd->commercant->nom_boutique ?? '-' }}</td>
                    <td class="p-4 text-[#FF6B00] font-bold">{{ $cmd->total }} FCFA</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $cmd->statut === 'en_attente' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                            {{ $cmd->statut === 'acceptee' ? 'bg-blue-500/10 text-blue-500' : '' }}
                            {{ $cmd->statut === 'en_livraison' ? 'bg-orange-500/10 text-orange-500' : '' }}
                            {{ $cmd->statut === 'livree' ? 'bg-green-500/10 text-green-500' : '' }}
                            {{ $cmd->statut === 'annulee' ? 'bg-red-500/10 text-red-500' : '' }}">
                            {{ $cmd->statut }}
                        </span>
                    </td>
                    <td class="p-4 text-[#8A8A8A]">{{ $cmd->livreur->user->nom ?? '-' }}</td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $cmd->created_at->format('d/m H:i') }}</td>
                    <td class="p-4">
                        <a href="{{ route('admin.commandes.show', $cmd->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs">👁️</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="p-8 text-center text-[#8A8A8A]">Aucune commande</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#2D2D2D]">{{ $commandes->links() }}</div>
    </div>
</div>
@endsection