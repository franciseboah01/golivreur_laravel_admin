@extends('admin.layouts.app')
@section('title', 'Avis - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-2">⭐ Avis clients</h1>
    <p class="text-[#8A8A8A] mb-8">Modération des avis et évaluations</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-[#121212] rounded-2xl p-6 text-center">
            <p class="text-4xl font-bold text-[#FF6B00]">4.8</p>
            <p class="text-[#8A8A8A] text-sm">Note moyenne</p>
        </div>
        <div class="bg-[#121212] rounded-2xl p-6 text-center">
            <p class="text-4xl font-bold text-white">0</p>
            <p class="text-[#8A8A8A] text-sm">Total avis</p>
        </div>
        <div class="bg-[#121212] rounded-2xl p-6 text-center">
            <p class="text-4xl font-bold text-yellow-500">0</p>
            <p class="text-[#8A8A8A] text-sm">En attente</p>
        </div>
    </div>

    <div class="bg-[#121212] rounded-2xl p-8 text-center">
        <p class="text-[#8A8A8A] text-lg">🚧 Module en construction</p>
        <p class="text-[#8A8A8A] text-sm mt-2">Les avis clients seront affichés ici prochainement.</p>
    </div>
</div>
@endsection