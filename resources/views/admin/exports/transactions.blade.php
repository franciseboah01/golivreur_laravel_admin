@extends('admin.layouts.app')
@section('title', 'Export Transactions')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.exports.index') }}" class="text-[#8A8A8A] hover:text-white transition">← Retour</a>
        <h1 class="text-3xl font-bold text-white">💰 Export Transactions</h1>
    </div>
    <div class="bg-[#121212] rounded-2xl p-8 text-center">
        <p class="text-[#8A8A8A]">🚧 Fonctionnalité à venir</p>
    </div>
</div>
@endsection