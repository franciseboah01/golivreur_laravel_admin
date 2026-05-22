@extends('admin.layouts.app')
@section('title', 'Admins en attente - GoLivreur Admin')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.admins.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">⏳ Administrateurs en attente</h1>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Zone</th>
                    <th class="p-4 text-left">Rôle</th>
                    <th class="p-4 text-left">Créé par</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E]">
                    <td class="p-4 text-white">{{ $admin->id }}</td>
                    <td class="p-4 text-white font-medium">{{ $admin->nom }} {{ $admin->prenom }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $admin->email }}</td>
                    <td class="p-4 text-white">{{ $admin->zone->nom ?? 'Toutes' }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $admin->roleAdmin->nom ?? 'N/A' }}</td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $admin->createur ? $admin->createur->nom . ' ' . $admin->createur->prenom : 'Système' }}</td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('admin.admins.valider', $admin->id) }}">
                                @csrf @method('PUT')
                                <button class="bg-green-500/10 hover:bg-green-500/20 text-green-500 px-3 py-1 rounded-lg text-xs font-bold">✅ Valider</button>
                            </form>
                            <form method="POST" action="{{ route('admin.admins.rejeter', $admin->id) }}">
                                @csrf @method('PUT')
                                <button class="bg-red-500/10 hover:bg-red-500/20 text-red-500 px-3 py-1 rounded-lg text-xs font-bold">❌ Rejeter</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="p-8 text-center text-[#8A8A8A]">Aucun administrateur en attente</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#2D2D2D]">{{ $admins->links() }}</div>
    </div>
</div>
@endsection