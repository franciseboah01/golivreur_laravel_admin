<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GoLivreur Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: { DEFAULT: '#FF6B00', light: '#FF8C42', dark: '#E65100' },
                        dark: { DEFAULT: '#0A0A0A', card: '#121212', input: '#1E1E1E', border: '#2D2D2D' },
                        grey: { DEFAULT: '#8A8A8A' }
                    }
                }
            }
        }
    </script>
    <style>
        body { background: #0A0A0A; color: #FFFFFF; font-family: 'Segoe UI', sans-serif; }
        .sidebar-link { transition: all 0.3s; }
        .sidebar-link:hover, .sidebar-link.active { background: #1E1E1E; border-left: 3px solid #FF6B00; color: #FF6B00; }
    </style>
</head>
<body class="flex">
    <aside class="w-64 bg-[#121212] min-h-screen p-4 flex flex-col">
        <div class="flex items-center gap-3 mb-8 p-2">
            <div class="w-10 h-10 bg-[#FF6B00] rounded-full flex items-center justify-center text-white font-bold">GL</div>
            <div>
                <div class="text-white font-bold text-sm">GoLivreur</div>
                <div class="text-[#8A8A8A] text-xs">Admin Panel</div>
            </div>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span> <span class="text-sm">Dashboard</span>
            </a>
            <a href="{{ route('admin.clients.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <span>👥</span> <span class="text-sm">Clients</span>
            </a>
            <a href="{{ route('admin.commercants.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.commercants.*') ? 'active' : '' }}">
                <span>🏪</span> <span class="text-sm">Commerçants</span>
            </a>
            <a href="{{ route('admin.livreurs.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.livreurs.*') ? 'active' : '' }}">
                <span>🛵</span> <span class="text-sm">Livreurs</span>
            </a>
            <a href="{{ route('admin.commandes.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}">
                <span>🛒</span> <span class="text-sm">Commandes</span>
            </a>
            <a href="{{ route('admin.colis.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.colis.*') ? 'active' : '' }}">
                <span>📦</span> <span class="text-sm">Colis</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span>🏷️</span> <span class="text-sm">Catégories</span>
            </a>
            <a href="{{ route('admin.codes-promo.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.codes-promo.*') ? 'active' : '' }}">
                <span>🎫</span> <span class="text-sm">Codes Promo</span>
            </a>
            <a href="{{ route('admin.parametres.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.parametres.*') ? 'active' : '' }}">
                <span>⚙️</span> <span class="text-sm">Paramètres</span>
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <span>💰</span> <span class="text-sm">Transactions</span>
            </a>
            <a href="{{ route('admin.avis.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.avis.*') ? 'active' : '' }}">
                <span>⭐</span> <span class="text-sm">Avis</span>
            </a>
            <a href="{{ route('admin.signalements.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.signalements.*') ? 'active' : '' }}">
                <span>⚠️</span> <span class="text-sm">Signalements</span>
            </a>
            <a href="{{ route('admin.notifications.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                <span>🔔</span> <span class="text-sm">Notifications</span>
            </a>
            <a href="{{ route('admin.zones.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.zones.*') ? 'active' : '' }}">
                <span>📍</span> <span class="text-sm">Zones</span>
            </a>
            <a href="{{ route('admin.bannieres.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.bannieres.*') ? 'active' : '' }}">
                <span>🖼️</span> <span class="text-sm">Bannières</span>
            </a>
            <a href="{{ route('admin.exports.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.exports.*') ? 'active' : '' }}">
                <span>📥</span> <span class="text-sm">Exports</span>
            </a>
            <a href="{{ route('admin.logs.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                <span>📋</span> <span class="text-sm">Logs</span>
            </a>
            @if(auth('admin')->user()->hasPermission('roles'))
                <a href="{{ route('admin.roles.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <span>🔑</span> <span class="text-sm">Rôles</span>
                </a>
            @endif

            @if(auth('admin')->user()->hasPermission('admins'))
                <a href="{{ route('admin.admins.index') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-[#8A8A8A] {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <span>👑</span> <span class="text-sm">Administrateurs</span>
                </a>
            @endif
        </nav>

        <div class="border-t border-[#2D2D2D] pt-4 mt-4">
            <div class="flex items-center gap-3 p-2">
                <div class="w-8 h-8 bg-[#FF6B00]/20 rounded-full flex items-center justify-center text-[#FF6B00] text-xs font-bold">
                    {{ substr(auth('admin')->user()->nom, 0, 1) }}{{ substr(auth('admin')->user()->prenom, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-white text-xs font-medium truncate">{{ auth('admin')->user()->nom }} {{ auth('admin')->user()->prenom }}</div>
                    <div class="text-[#8A8A8A] text-[10px] capitalize">{{ str_replace('_', ' ', auth('admin')->user()->role_admin) }}</div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-400 text-lg" title="Déconnexion">⏻</button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 p-8 min-h-screen overflow-y-auto">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-xl mb-6 text-sm">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>