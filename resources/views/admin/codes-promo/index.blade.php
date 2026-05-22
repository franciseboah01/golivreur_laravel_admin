@extends('admin.layouts.app')
@section('title', 'Codes Promo - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">🎫 Codes Promo</h1>
        <a href="{{ route('admin.codes-promo.create') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">+ Nouveau</a>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">Code</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Valeur</th>
                    <th class="p-4 text-left">Min</th>
                    <th class="p-4 text-left">Utilisations</th>
                    <th class="p-4 text-left">Expire</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($codes as $c)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E]">
                    <td class="p-4 text-white font-bold font-mono">{{ $c->code }}</td>
                    <td class="p-4 text-white">{{ str_replace('_', ' ', $c->type) }}</td>
                    <td class="p-4 text-[#FF6B00] font-bold">{{ $c->valeur }}{{ $c->type === 'pourcentage' ? '%' : ' FCFA' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->montant_min }} FCFA</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $c->utilisations }}/{{ $c->max_utilisation ?? '∞' }}</td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $c->expire_le ? $c->expire_le->format('d/m/Y') : '-' }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $c->actif ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                            {{ $c->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.codes-promo.edit', $c->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs">✏️</a>
                            <form method="POST" action="{{ route('admin.codes-promo.destroy', $c->id) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-3 py-1 rounded-lg text-xs">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="p-8 text-center text-[#8A8A8A]">Aucun code promo</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection