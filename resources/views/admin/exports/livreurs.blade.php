@extends('admin.layouts.app')
@section('title', 'Export Livreurs')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.exports.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">🛵 Export Livreurs</h1>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Téléphone</th>
                    <th class="p-4 text-left">Véhicule</th>
                    <th class="p-4 text-left">Zone</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($livreurs as $l)
                <tr class="border-b border-[#2D2D2D]">
                    <td class="p-4 text-white">{{ $l->id }}</td>
                    <td class="p-4 text-white">{{ $l->user->nom ?? '' }} {{ $l->user->prenom ?? '' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $l->user->telephone ?? '-' }}</td>
                    <td class="p-4 text-white">{{ $l->vehicule_type }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $l->zone_couverture }}</td>
                    <td class="p-4 text-white">{{ $l->statut }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $l->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection