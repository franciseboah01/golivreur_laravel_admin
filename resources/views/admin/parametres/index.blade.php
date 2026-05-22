@extends('admin.layouts.app')
@section('title', 'Paramètres - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-2">⚙️ Paramètres</h1>
    <p class="text-[#8A8A8A] mb-8">Configuration de la plateforme</p>

    <form method="POST" action="{{ route('admin.parametres.update') }}">
        @csrf
        @foreach($parametres as $groupe => $params)
        <div class="bg-[#121212] rounded-2xl p-6 mb-6">
            <h2 class="text-lg font-bold text-white mb-4 capitalize">{{ $groupe }}</h2>
            <div class="space-y-4">
                @foreach($params as $p)
                <div>
                    <label class="block text-[#8A8A8A] text-sm mb-2">{{ $p->description ?? $p->cle }}</label>
                    <input type="text" name="{{ $p->cle }}" value="{{ $p->valeur }}"
                        class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <button type="submit" class="bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 px-8 rounded-xl transition">
            💾 Enregistrer
        </button>
    </form>
</div>
@endsection