@extends('admin.layouts.app')
@section('title', 'Modifier zone')

@section('content')
<div class="max-w-xl">
    <h1 class="text-3xl font-bold text-white mb-6">✏️ {{ $zone->nom }}</h1>

    <form method="POST" action="{{ route('admin.zones.update', $zone->id) }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom de la ville *</label>
            <input type="text" name="nom" value="{{ old('nom', $zone->nom) }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Code</label>
            <input type="text" name="code" value="{{ old('code', $zone->code) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[#8A8A8A] text-sm mb-2">Latitude</label>
                <input type="number" step="any" name="latitude" value="{{ old('latitude', $zone->latitude) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
            </div>
            <div>
                <label class="block text-[#8A8A8A] text-sm mb-2">Longitude</label>
                <input type="number" step="any" name="longitude" value="{{ old('longitude', $zone->longitude) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
            </div>
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Rayon de livraison (km)</label>
            <input type="number" name="rayon_km" value="{{ old('rayon_km', $zone->rayon_km) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[#8A8A8A] text-sm mb-2">Frais base (FCFA)</label>
                <input type="number" name="frais_livraison_base" value="{{ old('frais_livraison_base', $zone->frais_livraison_base) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
            </div>
            <div>
                <label class="block text-[#8A8A8A] text-sm mb-2">Frais/km (FCFA)</label>
                <input type="number" name="frais_livraison_km" value="{{ old('frais_livraison_km', $zone->frais_livraison_km) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
            </div>
        </div>
        <div>
            <label class="flex items-center gap-2 text-white cursor-pointer">
                <input type="checkbox" name="actif" {{ $zone->actif ? 'checked' : '' }} class="accent-[#FF6B00]"> Actif
            </label>
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl transition">Enregistrer</button>
    </form>
</div>
@endsection