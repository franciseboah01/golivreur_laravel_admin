@extends('admin.layouts.app')
@section('title', 'Bannières - GoLivreur Admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">🖼️ Bannières</h1>
            <p class="text-[#8A8A8A] mt-1">Gérez les bannières promotionnelles</p>
        </div>
        <a href="{{ route('admin.bannieres.create') }}" class="bg-[#FF6B00] hover:bg-[#E65100] text-white px-4 py-2 rounded-xl text-sm font-bold transition">+ Nouvelle</a>
    </div>

    <div class="bg-[#121212] rounded-2xl p-8 text-center">
        <p class="text-[#8A8A8A] text-lg">🚧 Module en construction</p>
        <p class="text-[#8A8A8A] text-sm mt-2">Les bannières promotionnelles seront gérables ici.</p>
    </div>
</div>
@endsection