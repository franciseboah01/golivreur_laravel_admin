@extends('admin.layouts.app')
@section('title', 'Modifier Client')

@section('content')
<div class="max-w-xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.clients.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">✏️ {{ $client->nom }} {{ $client->prenom }}</h1>
    </div>

    <form method="POST" action="{{ route('admin.clients.update', $client->id) }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom</label>
            <input type="text" name="nom" value="{{ $client->nom }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Prénom</label>
            <input type="text" name="prenom" value="{{ $client->prenom }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Téléphone</label>
            <input type="text" name="telephone" value="{{ $client->telephone }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Email</label>
            <input type="email" name="email" value="{{ $client->email }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl transition">Enregistrer</button>
    </form>
</div>
@endsection