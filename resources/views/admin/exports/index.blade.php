@extends('admin.layouts.app')
@section('title', 'Exports - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-2">📥 Exports</h1>
    <p class="text-[#8A8A8A] mb-8">Téléchargez les données au format CSV</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.exports.commandes') }}" class="bg-[#121212] rounded-2xl p-6 hover:bg-[#1E1E1E] transition text-center">
            <span class="text-4xl">🛒</span>
            <h2 class="text-lg font-bold text-white mt-4">Commandes</h2>
            <p class="text-[#8A8A8A] text-sm">Exporter toutes les commandes</p>
        </a>
        <a href="{{ route('admin.exports.colis') }}" class="bg-[#121212] rounded-2xl p-6 hover:bg-[#1E1E1E] transition text-center">
            <span class="text-4xl">📦</span>
            <h2 class="text-lg font-bold text-white mt-4">Colis</h2>
            <p class="text-[#8A8A8A] text-sm">Exporter tous les colis</p>
        </a>
        <a href="{{ route('admin.exports.transactions') }}" class="bg-[#121212] rounded-2xl p-6 hover:bg-[#1E1E1E] transition text-center">
            <span class="text-4xl">💰</span>
            <h2 class="text-lg font-bold text-white mt-4">Transactions</h2>
            <p class="text-[#8A8A8A] text-sm">Exporter les données financières</p>
        </a>
        <a href="{{ route('admin.exports.utilisateurs') }}" class="bg-[#121212] rounded-2xl p-6 hover:bg-[#1E1E1E] transition text-center">
            <span class="text-4xl">👥</span>
            <h2 class="text-lg font-bold text-white mt-4">Utilisateurs</h2>
            <p class="text-[#8A8A8A] text-sm">Exporter la liste des utilisateurs</p>
        </a>
        <a href="{{ route('admin.exports.livreurs') }}" class="bg-[#121212] rounded-2xl p-6 hover:bg-[#1E1E1E] transition text-center">
            <span class="text-4xl">🛵</span>
            <h2 class="text-lg font-bold text-white mt-4">Livreurs</h2>
            <p class="text-[#8A8A8A] text-sm">Exporter la liste des livreurs</p>
        </a>
        <a href="{{ route('admin.exports.commercants') }}" class="bg-[#121212] rounded-2xl p-6 hover:bg-[#1E1E1E] transition text-center">
            <span class="text-4xl">🏪</span>
            <h2 class="text-lg font-bold text-white mt-4">Commerçants</h2>
            <p class="text-[#8A8A8A] text-sm">Exporter la liste des commerçants</p>
        </a>
    </div>
</div>
@endsection