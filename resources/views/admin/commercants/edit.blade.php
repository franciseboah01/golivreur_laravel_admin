@extends('admin.layouts.app')
@section('title', 'Modifier Commerçant')

@section('content')
<div class="max-w-xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.commercants.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">✏️ {{ $commercant->nom_boutique }}</h1>
    </div>

    <form method="POST" action="{{ route('admin.commercants.update', $commercant->id) }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom boutique</label>
            <input type="text" name="nom_boutique" value="{{ $commercant->nom_boutique }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Catégorie</label>
            <input type="text" name="categorie" value="{{ $commercant->categorie }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Adresse</label>
            <input type="text" name="adresse" value="{{ $commercant->adresse }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Téléphone</label>
            <input type="text" name="telephone_boutique" value="{{ $commercant->telephone_boutique }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl transition">Enregistrer</button>
    </form>
</div>
@endsection