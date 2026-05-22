@extends('admin.layouts.app')
@section('title', 'Notifications - GoLivreur Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-white mb-6">🔔 Notifications</h1>

    <div class="bg-[#121212] rounded-2xl p-6 mb-8">
        <h2 class="text-lg font-bold text-white mb-4">📢 Envoyer une notification</h2>
        <form method="POST" action="{{ route('admin.notifications.envoyer') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[#8A8A8A] text-sm mb-2">Titre</label>
                <input type="text" name="titre" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none">
            </div>
            <div>
                <label class="block text-[#8A8A8A] text-sm mb-2">Message</label>
                <textarea name="message" rows="3" required class="w-full bg-[#1E1E1E] border border-[#2D2D2D] focus:border-[#FF6B00] rounded-xl p-3 text-white outline-none"></textarea>
            </div>
            <button type="submit" class="bg-[#FF6B00] hover:bg-[#E65100] text-white font-bold py-3 px-6 rounded-xl">📤 Envoyer à tous</button>
        </form>
    </div>

    <div class="bg-[#121212] rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-[#2D2D2D] text-[#8A8A8A]">
                    <th class="p-4 text-left">Utilisateur</th>
                    <th class="p-4 text-left">Titre</th>
                    <th class="p-4 text-left">Message</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Lu</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $n)
                <tr class="border-b border-[#2D2D2D] hover:bg-[#1E1E1E]">
                    <td class="p-4 text-white">{{ $n->user->nom ?? 'Système' }}</td>
                    <td class="p-4 text-white font-medium">{{ $n->titre }}</td>
                    <td class="p-4 text-[#8A8A8A]">{{ Str::limit($n->message, 50) }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#FF6B00]/10 text-[#FF6B00]">{{ $n->type }}</span>
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $n->lu ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                            {{ $n->lu ? 'Oui' : 'Non' }}
                        </span>
                    </td>
                    <td class="p-4 text-[#8A8A8A] text-xs">{{ $n->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-8 text-center text-[#8A8A8A]">Aucune notification</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#2D2D2D]">{{ $notifications->links() }}</div>
    </div>
</div>
@endsection