@extends('admin.layouts.app')
@section('title', 'Signalements - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-2">⚠️ Signalements</h1>
    <p class="text-[#8A8A8A] mb-8">Problèmes signalés par les utilisateurs</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-[#121212] rounded-2xl p-6 text-center">
            <p class="text-4xl font-bold text-red-500">0</p>
            <p class="text-[#8A8A8A] text-sm">En attente</p>
        </div>
        <div class="bg-[#121212] rounded-2xl p-6 text-center">
            <p class="text-4xl font-bold text-yellow-500">0</p>
            <p class="text-[#8A8A8A] text-sm">En cours</p>
        </div>
        <div class="bg-[#121212] rounded-2xl p-6 text-center">
            <p class="text-4xl font-bold text-green-500">0</p>
            <p class="text-[#8A8A8A] text-sm">Résolus</p>
        </div>
    </div>

    <div class="bg-[#121212] rounded-2xl p-8 text-center">
        <p class="text-[#8A8A8A] text-lg">🚧 Module en construction</p>
        <p class="text-[#8A8A8A] text-sm mt-2">Les signalements apparaîtront ici.</p>
    </div>
</div>
@endsection