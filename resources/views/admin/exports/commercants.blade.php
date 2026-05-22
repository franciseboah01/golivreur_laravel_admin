@extends('admin.layouts.app')
@section('title', 'Export Commerçants')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.exports.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">🏪 Export Commerçants</h1>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Boutique</th>
                    <th class="p-4 text-left">Propriétaire</th>
                    <th class="p-4 text-left">Catégorie</th>
                    <th class="p-4 text-left">Adresse</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commercants as $c)
                <tr class="border-b border-[#2D2D2D]">
                    <td class="p-4 text-white">{{ $c->id }}</td>
                    <td class="p-4 text-white">{{ $c->nom_boutique }}</td>
                    <td class="p-4 text-white">{{ $c->user->nom ?? '' }} {{ $c->user->prenom ?? '' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->categorie }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->adresse }}</td>
                    <td class="p-4 text-white">{{ $c->statut }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection