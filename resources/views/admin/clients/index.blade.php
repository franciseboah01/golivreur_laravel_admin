@extends('admin.layouts.app')
@section('title', 'Clients - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">👥 Clients</h1>
            <p class="text-[#8A8A8A] mt-1">Liste de tous les clients</p>
        </div>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">Nom</th>
                        <th class="p-4 text-left">Téléphone</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Commandes</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E] transition">
                        <td class="p-4 text-white">{{ $client->id }}</td>
                        <td class="p-4 text-white font-medium">{{ $client->nom }} {{ $client->prenom }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $client->telephone }}</td>
                        <td class="p-4 text-[#8A8A8A]">{{ $client->email ?? '-' }}</td>
                        <td class="p-4">
                            <span class="bg-[#FF6B00]/10 text-[#FF6B00] px-3 py-1 rounded-full text-xs font-bold">
                                {{ $client->commandes_count ?? 0 }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $client->statut ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                                {{ $client->statut ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">✏️</a>
                                <a href="{{ route('admin.clients.show', $client->id) }}" class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">👁️</a>
                                <form method="POST" action="{{ route('admin.clients.toggle', $client->id) }}">
                                    @csrf @method('PUT')
                                    <button class="bg-[#1E1E1E] hover:bg-[#2D2D2D] text-[#8A8A8A] px-3 py-1 rounded-lg text-xs transition">
                                        {{ $client->statut ? '🔒' : '🔓' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="p-8 text-center text-[#8A8A8A]">Aucun client</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#2D2D2D]">
            {{ $clients->links() }}
        </div>
    </div>
</div>
@endsection