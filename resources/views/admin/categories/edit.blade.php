@extends('admin.layouts.app')
@section('title', 'Modifier catégorie')

@section('content')
<div class="max-w-xl">
    <h1 class="text-3xl font-bold text-white mb-6">✏️ {{ $categorie->nom }}</h1>
    <form method="POST" action="{{ route('admin.categories.update', $categorie->id) }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom</label>
            <input type="text" name="nom" value="{{ $categorie->nom }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Icône (emoji)</label>
            <input type="text" name="icone" value="{{ $categorie->icone }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Ordre</label>
            <input type="number" name="ordre" value="{{ $categorie->ordre }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="flex items-center gap-2 text-white cursor-pointer">
                <input type="checkbox" name="actif" {{ $categorie->actif ? 'checked' : '' }} class="accent-[#FF6B00]"> Actif
            </label>
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl">Enregistrer</button>
    </form>
</div>
@endsection