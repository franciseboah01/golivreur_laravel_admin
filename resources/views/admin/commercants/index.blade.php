@extends('admin.layouts.app')
@section('title', 'Commerçants - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">🏪 Commerçants</h1>
            <p class="text-[#8A8A8A] mt-1">Liste de tous les commerçants</p>
        </div>
        <a href="{{ route('admin.commercants.attente') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">
            ⏳ En attente de validation
        </a>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">Boutique</th>
                        <th class="p-4 text-left">Propriétaire</th>
                        <th class="p-4 text-left">Catégorie</th>
                        <th class="p-4 text-left">Téléphone</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commercants as $c)
                    <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                        <td class="p-4 text-white">{{ $c->id }}</td>
                        <td class="p-4 text-white font-medium">{{ $c->nom_boutique }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $c->user->nom ?? '' }} {{ $c->user->prenom ?? '' }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $c->categorie ?? '-' }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $c->telephone_boutique ?? $c->user->telephone ?? '-' }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $c->statut === 'actif' ? 'bg-green-500/10 text-green-500' : ($c->statut === 'en_attente' ? 'bg-yellow-500/10 text-yellow-500' : 'bg-red-500/10 text-red-500') }}">
                                {{ $c->statut }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.clients.edit', $c->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">✏️</a>
                                <a href="{{ route('admin.commercants.show', $c->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs">👁️</a>
                                @if($c->statut === 'en_attente')
                                <form method="POST" action="{{ route('admin.commercants.valider', $c->id) }}">
                                    @csrf @method('PUT')
                                    <button class="bg-green-500/10 hover:bg-green-500/20 text-green-500 px-3 py-1 rounded-lg text-xs font-bold">✅</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="p-8 text-center text-[#8A8A8A]">Aucun commerçant</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#2D2D2D]">
            {{ $commercants->links() }}
        </div>
    </div>
</div>
@endsection