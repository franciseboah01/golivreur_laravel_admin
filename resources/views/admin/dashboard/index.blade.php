@extends('admin.layouts.app')
@section('title', 'Dashboard - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-2">📊 Dashboard</h1>
    <p class="text-[#8A8A8A] mb-8">Vue d'ensemble de la plateforme</p>

    <!-- KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
        $kpis = [
            ['label' => 'Total Clients', 'value' => $stats['total_clients'] ?? 0, 'color' => 'border-blue-500', 'icon' => '👥', 'bg' => 'bg-blue-500/10'],
            ['label' => 'Commerçants', 'value' => $stats['total_commercants'] ?? 0, 'color' => 'border-green-500', 'icon' => '🏪', 'bg' => 'bg-green-500/10'],
            ['label' => 'Livreurs', 'value' => $stats['total_livreurs'] ?? 0, 'color' => 'border-purple-500', 'icon' => '🛵', 'bg' => 'bg-purple-500/10'],
            ['label' => 'Revenus', 'value' => ($stats['revenus_total'] ?? 0) . ' FCFA', 'color' => 'border-orange', 'icon' => '💰', 'bg' => 'bg-orange/10'],
        ];
        @endphp

        @foreach($kpis as $kpi)
        <div class="bg-[#121212] rounded-2xl p-6 border-l-4 {{ $kpi['color'] }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#8A8A8A] text-sm">{{ $kpi['label'] }}</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $kpi['value'] }}</p>
                </div>
                <div class="w-12 h-12 {{ $kpi['bg'] }} rounded-full flex items-center justify-center text-2xl">
                    {{ $kpi['icon'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Commandes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📋 Commandes</h2>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-[#8A8A8A]">En attente</span>
                    <span class="text-yellow-500 font-bold">{{ $stats['commandes_en_attente'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-[#8A8A8A]">En livraison</span>
                    <span class="text-orange font-bold">{{ $stats['commandes_en_livraison'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-[#8A8A8A]">Livrées</span>
                    <span class="text-green-500 font-bold">{{ $stats['commandes_livrees'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between text-sm font-bold border-t border-[#2D2D2D] pt-3">
                    <span class="text-white">Total</span>
                    <span class="text-white">{{ $stats['total_commandes'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="bg-[#121212] rounded-2xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">📈 Activité du jour</h2>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-[#8A8A8A]">Commandes aujourd'hui</span>
                    <span class="text-orange font-bold">{{ $stats['commandes_du_jour'] ?? 0 }}</span>
                </div>
            </div>
            <div class="mt-6 p-4 bg-[#1E1E1E] rounded-xl text-center">
                <p class="text-[#8A8A8A] text-sm">Statut de la plateforme</p>
                <p class="text-green-500 font-bold mt-1">🟢 Opérationnelle</p>
            </div>
        </div>
    </div>
</div>
@endsection