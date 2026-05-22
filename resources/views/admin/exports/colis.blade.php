@extends('admin.layouts.app')
@section('title', 'Export Colis')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.exports.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">📦 Export Colis</h1>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Expéditeur</th>
                    <th class="p-4 text-left">Destinataire</th>
                    <th class="p-4 text-left">De → À</th>
                    <th class="p-4 text-left">Prix</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colis as $c)
                <tr class="border-b border-[#2D2D2D]">
                    <td class="p-4 text-white">#{{ $c->id }}</td>
                    <td class="p-4 text-white">{{ $c->expediteur->nom ?? '' }}</td>
                    <td class="p-4 text-white">{{ $c->destinataire_nom }}</td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $c->adresse_ramassage }} → {{ $c->adresse_livraison }}</td>
                    <td class="p-4 text-[#FF6B00] font-bold">{{ $c->prix_livraison }}</td>
                    <td class="p-4 text-white">{{ $c->statut }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection