@extends('admin.layouts.app')
@section('title', 'Créer un rôle')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-white mb-6">➕ Nouveau rôle</h1>

    <form method="POST" action="{{ route('admin.roles.store') }}" class="bg-[#121212] rounded-2xl p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-[#8A8A8A] text-sm mb-2">Nom du rôle *</label>
            <input type="text" name="nom" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-[#8A8A8A] text-sm mb-2">Description</label>
            <input type="text" name="description" class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
        </div>
        <div class="mb-6">
            <label class="block text-[#8A8A8A] text-sm mb-3">Permissions</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach(\App\Http\Controllers\Admin\RoleAdminController::$allPermissions as $key => $label)
                <label class="flex items-center gap-2 text-white text-sm cursor-pointer">
                    <input type="checkbox" name="permissions[]" value="{{ $key }}" class="accent-[#FF6B00]">
                    {{ $label }}
                </label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 px-6 rounded-xl transition">Créer le rôle</button>
    </form>
</div>
@endsection