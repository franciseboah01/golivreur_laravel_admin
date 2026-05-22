@extends('admin.layouts.app')
@section('title', 'Transactions - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-2">💰 Transactions</h1>
    <p class="text-[#8A8A8A] mb-8">Suivi financier de la plateforme</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-[#121212] rounded-2xl p-6">
            <p class="text-[#8A8A8A] text-sm">Total généré</p>
            <p class="text-2xl font-bold text-[#FF6B00]">{{ number_format($total, 0, ',', ' ') }} FCFA</p>
        </div>
        <div class="bg-[#121212] rounded-2xl p-6">
            <p class="text-[#8A8A8A] text-sm">Commission (10%)</p>
            <p class="text-2xl font-bold text-green-500">{{ number_format($commission, 0, ',', ' ') }} FCFA</p>
        </div>
        <div class="bg-[#121212] rounded-2xl p-6">
            <p class="text-[#8A8A8A] text-sm">Commandes livrées</p>
            <p class="text-2xl font-bold text-white">{{ $commandes->where('statut', 'livree')->count() }}</p>
        </div>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Client</th>
                    <th class="p-4 text-left">Boutique</th>
                    <th class="p-4 text-left">Livreur</th>
                    <th class="p-4 text-left">Montant</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandes as $cmd)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E]">
                    <td class="p-4 text-white">#{{ $cmd->id }}</td>
                    <td class="p-4 text-white">{{ $cmd->client->nom ?? '' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $cmd->commercant->nom_boutique ?? '-' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $cmd->livreur->user->nom ?? '-' }}</td>
                    <td class="p-4 text-[#FF6B00] font-bold">{{ $cmd->total }} FCFA</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $cmd->statut === 'livree' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                            {{ $cmd->statut }}
                        </span>
                    </td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $cmd->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="p-8 text-center text-[#8A8A8A]">Aucune transaction</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#2D2D2D]">{{ $commandes->links() }}</div>
    </div>
</div>
@endsection