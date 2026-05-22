@extends('admin.layouts.app')
@section('title', 'Export Utilisateurs')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.exports.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">👥 Export Utilisateurs</h1>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Téléphone</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Rôle</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="border-b border-[#2D2D2D]">
                    <td class="p-4 text-white">{{ $u->id }}</td>
                    <td class="p-4 text-white">{{ $u->nom }} {{ $u->prenom }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $u->telephone }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $u->email ?? '-' }}</td>
                    <td class="p-4 text-white">{{ $u->role }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ $u->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection