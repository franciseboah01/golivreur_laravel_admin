@extends('admin.layouts.app')
@section('title', 'Nouvelle catégorie')

@section('content')
<div class="max-w-xl">
    <h1 class="text-3xl font-bold text-white mb-6">➕ Nouvelle catégorie</h1>
    <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom</label>
            <input type="text" name="nom" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Icône (emoji)</label>
            <input type="text" name="icone" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Ordre</label>
            <input type="number" name="ordre" value="0" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl">Créer</button>
    </form>
</div>
@endsection