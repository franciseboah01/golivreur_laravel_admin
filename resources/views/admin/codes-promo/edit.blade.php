@extends('admin.layouts.app')
@section('title', 'Modifier code promo')

@section('content')
<div class="max-w-xl">
    <h1 class="text-3xl font-bold text-white mb-6">✏️ {{ $code->code }}</h1>
    <form method="POST" action="{{ route('admin.codes-promo.update', $code->id) }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Code</label>
            <input type="text" name="code" value="{{ $code->code }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none font-mono">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Type</label>
            <select name="type" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
                <option value="pourcentage" {{ $code->type === 'pourcentage' ? 'selected' : '' }}>Pourcentage (%)</option>
                <option value="montant_fixe" {{ $code->type === 'montant_fixe' ? 'selected' : '' }}>Montant fixe (FCFA)</option>
                <option value="livraison_gratuite" {{ $code->type === 'livraison_gratuite' ? 'selected' : '' }}>Livraison gratuite</option>
            </select>
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Valeur</label>
            <input type="number" name="valeur" value="{{ $code->valeur }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Montant minimum</label>
            <input type="number" name="montant_min" value="{{ $code->montant_min }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Utilisations max</label>
            <input type="number" name="max_utilisation" value="{{ $code->max_utilisation }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Expire le</label>
            <input type="date" name="expire_le" value="{{ $code->expire_le ? $code->expire_le->format('Y-m-d') : '' }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="flex items-center gap-2 text-white cursor-pointer">
                <input type="checkbox" name="actif" {{ $code->actif ? 'checked' : '' }} class="accent-[#FF6B00]"> Actif
            </label>
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl">Enregistrer</button>
    </form>
</div>
@endsection