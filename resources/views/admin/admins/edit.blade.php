@extends('admin.layouts.app')
@section('title', 'Modifier administrateur')

@section('content')
<div class="max-w-xl">
    <h1 class="text-3xl font-bold text-white mb-6">✏️ Modifier : {{ $admin->nom }} {{ $admin->prenom }}</h1>

    <form method="POST" action="{{ route('admin.admins.update', $admin->id) }}" class="bg-[#121212] rounded-2xl p-6 space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom', $admin->nom) }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Prénom *</label>
            <input type="text" name="prenom" value="{{ old('prenom', $admin->prenom) }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Email *</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Téléphone</label>
            <input type="text" name="telephone" value="{{ old('telephone', $admin->telephone) }}" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Rôle *</label>
            <select name="role_admin_id" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $admin->role_admin_id == $role->id ? 'selected' : '' }} class="bg-[#1E1E1E]">{{ $role->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[#8A8A8A] text-sm mb-2">Ville (zone) *</label>
            <select name="zone_id" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none transition">
                @if(!auth('admin')->user()->zone_id)
                    <option value="">Toutes les villes (Super Admin)</option>
                @endif
                @foreach(\App\Models\Zone::where('actif', true)->orderBy('nom')->get() as $zone)
                    <option value="{{ $zone->id }}" {{ old('zone_id', $admin->zone_id) == $zone->id ? 'selected' : '' }} class="bg-[#1E1E1E]">{{ $zone->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl transition">Enregistrer</button>
    </form>
</div>
@endsection