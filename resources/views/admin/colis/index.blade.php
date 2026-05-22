@extends('admin.layouts.app')
@section('title', 'Colis - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-6">📦 Colis</h1>

    <div class="bg-[#121212] rounded-2xl p-4 mb-6 flex flex-wrap gap-3">
        <a href="{{ route('admin.colis.index') }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ !request('statut') ? 'bg-[#FF6B00] text-white' : 'bg-[#1E1E1E] text-[#8A8A8A]' }}">Tous</a>
        @foreach(['en_attente', 'accepte', 'ramasse', 'en_livraison', 'livre', 'annule'] as $s)
        <a href="{{ route('admin.colis.index', ['statut' => $s]) }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ request('statut') === $s ? 'bg-[#FF6B00] text-white' : 'bg-[#1E1E1E] text-[#8A8A8A]' }}">{{ str_replace('_', ' ', ucfirst($s)) }}</a>
        @endforeach
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Expéditeur</th>
                    <th class="p-4 text-left">Destinataire</th>
                    <th class="p-4 text-left">De → À</th>
                    <th class="p-4 text-left">Prix</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Livreur</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($colis as $c)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                    <td class="p-4 text-white">#{{ $c->id }}</td>
                    <td class="p-4 text-white">{{ $c->expediteur->nom ?? '' }}</td>
                    <td class="p-4 text-white">{{ $c->destinataire_nom }}</td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $c->adresse_ramassage }} → {{ $c->adresse_livraison }}</td>
                    <td class="p-4 text-[#FF6B00] font-bold">{{ $c->prix_livraison }} FCFA</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $c->statut === 'en_attente' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                            {{ $c->statut === 'livre' ? 'bg-green-500/10 text-green-500' : '' }}
                            {{ $c->statut === 'annule' ? 'bg-red-500/10 text-red-500' : '' }}
                            {{ in_array($c->statut, ['accepte', 'ramasse', 'en_livraison']) ? 'bg-orange-500/10 text-orange-500' : '' }}">
                            {{ $c->statut }}
                        </span>
                    </td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->livreur->user->nom ?? '-' }}</td>
                    <td class="p-4">
                        <a href="{{ route('admin.colis.show', $c->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs">👁️</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="p-8 text-center text-[#8A8A8A]">Aucun colis</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#2D2D2D]">{{ $colis->links() }}</div>
    </div>
</div>
@endsection