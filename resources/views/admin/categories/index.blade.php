@extends('admin.layouts.app')
@section('title', 'Catégories - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">🏷️ Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">+ Nouvelle</a>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">Icône</th>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Ordre</th>
                    <th class="p-4 text-left">Statut</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E]">
                    <td class="p-4 text-2xl">{{ $cat->icone ?? '🏷️' }}</td>
                    <td class="p-4 text-white font-medium">{{ $cat->nom }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $cat->ordre }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $cat->actif ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                            {{ $cat->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs">✏️</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-3 py-1 rounded-lg text-xs">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-8 text-center text-[#8A8A8A]">Aucune catégorie</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection