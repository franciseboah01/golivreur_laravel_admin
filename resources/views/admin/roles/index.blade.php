@extends('admin.layouts.app')
@section('title', 'Rôles - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">🔑 Rôles</h1>
            <p class="text-[#8A8A8A] mt-1">Gestion des rôles administrateurs</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">+ Nouveau rôle</a>
    </div>

    <div class="grid gap-4">
        @foreach($roles as $role)
        <div class="bg-[#121212] rounded-2xl p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-white font-bold text-lg">{{ $role->nom }}</h3>
                    <p class="text-[#8A8A8A] text-sm">{{ $role->description ?? 'Aucune description' }}</p>
                    <div class="flex flex-wrap gap-1 mt-3">
                        @foreach($role->permissions as $p)
                        <span class="bg-[#1E1E1E] text-[#8A8A8A] px-2 py-0.5 rounded text-xs">{{ $p }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $role->actif ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">{{ $role->actif ? 'Actif' : 'Inactif' }}</span>
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-[#FF6B00]">✏️</a>
                    <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection