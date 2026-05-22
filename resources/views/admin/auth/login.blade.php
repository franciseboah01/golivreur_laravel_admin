@extends('admin.layouts.guest')
@section('title', 'Connexion Admin - GoLivreur')

@section('content')
<div class="w-full max-w-md p-8 bg-[#121212] rounded-2xl border border-[#2D2D2D] shadow-2xl">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-[#FF6B00] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl font-bold text-white">GL</span>
        </div>
        <h1 class="text-2xl font-bold text-white">GoLivreur Admin</h1>
        <p class="text-[#8A8A8A] text-sm mt-2">Connectez-vous à votre espace</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-xl mb-6 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-[#8A8A8A] text-sm mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none transition">
        </div>
        <div class="mb-6">
            <label class="block text-[#8A8A8A] text-sm mb-2">Mot de passe</label>
            <input type="password" name="password" required
                class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none transition">
        </div>
        <button type="submit"
            class="w-full bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 rounded-xl transition">
            Se connecter
        </button>
    </form>
</div>
@endsection