@extends('admin.layouts.app')
@section('title', 'Nouveau code promo')

@section('content')
<div class="max-w-xl">
    <h1 class="text-3xl font-bold text-white mb-6">➕ Nouveau code promo</h1>
    <form method="POST" action="{{ route('admin.codes-promo.store') }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Code</label>
            <input type="text" name="code" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none font-mono">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Type</label>
            <select name="type" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
                <option value="pourcentage">Pourcentage (%)</option>
                <option value="montant_fixe">Montant fixe (FCFA)</option>
                <option value="livraison_gratuite">Livraison gratuite</option>
            </select>
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Valeur</label>
            <input type="number" name="valeur" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Montant minimum (FCFA)</label>
            <input type="number" name="montant_min" value="0" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Utilisations max (vide = illimité)</label>
            <input type="number" name="max_utilisation" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Expire le</label>
            <input type="date" name="expire_le" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl">Créer</button>
    </form>
</div>
@endsection