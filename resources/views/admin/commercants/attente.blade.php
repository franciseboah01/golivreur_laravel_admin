@extends('admin.layouts.app')
@section('title', 'Commerçants en attente - GoLivreur Admin')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.commercants.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">⏳ Commerçants en attente</h1>
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
                        <th class="p-4 text-left">Action</th>
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
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/10 text-yellow-500">{{ $c->statut }}</span>
                        </td>
                        <td class="p-4">
                            <form method="POST" action="{{ route('admin.commercants.valider', $c->id) }}">
                                @csrf @method('PUT')
                                <button class="bg-green-500/10 hover:bg-green-500/20 text-green-500 px-3 py-1 rounded-lg text-xs font-bold">✅ Valider</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="p-8 text-center text-[#8A8A8A]">Aucun commerçant en attente</td></tr>
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