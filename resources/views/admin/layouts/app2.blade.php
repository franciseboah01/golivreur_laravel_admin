<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title', 'GoLivreur Admin')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: { DEFAULT: '#FF6B00', light: '#FF8C42', dark: '#E65100' },
                        dark: { DEFAULT: '#0A0A0A', card: '#121212', input: '#1E1E1E', border: '#2D2D2D' },
                        grey: { DEFAULT: '#8A8A8A' }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'Segoe UI', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'pulse-glow': 'pulseGlow 2s infinite',
                    }
                }
            }
        }
    </script>
    
    <style>
        * {
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }
        
        body {
            background: #0A0A0A;
            color: #FFFFFF;
            overflow-x: hidden;
        }
        
        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1E1E1E;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #FF6B00;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #FF8C42;
        }
        
        /* Sidebar animations */
        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: rgba(255, 107, 0, 0.1);
            transition: width 0.3s ease;
        }
        
        .sidebar-link:hover::before {
            width: 100%;
        }
        
        .sidebar-link:hover, .sidebar-link.active {
            background: #1E1E1E;
            border-left: 3px solid #FF6B00;
            color: #FF6B00;
        }
        
        .sidebar-link i {
            transition: transform 0.2s ease;
        }
        
        .sidebar-link:hover i {
            transform: translateX(3px);
        }
        
        /* Animation fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Animation slide-in */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Pulse glow pour notifications */
        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(255, 107, 0, 0.4);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(255, 107, 0, 0);
            }
        }
        
        /* Glassmorphisme */
        .glass-card {
            background: rgba(18, 18, 18, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 107, 0, 0.15);
        }
        
        /* Dropdown animation */
        .dropdown-enter {
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .dropdown-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.2s ease;
        }
        
        /* Mobile sidebar overlay */
        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }
        
        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: #FF6B00;
            color: white;
            font-size: 10px;
            font-weight: bold;
            min-width: 16px;
            height: 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
        }
        
        /* Loading spinner */
        .spinner {
            border: 2px solid rgba(255, 107, 0, 0.2);
            border-top-color: #FF6B00;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                transition: transform 0.3s ease;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="flex">
    <!-- Overlay mobile -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/70 backdrop-blur-sm z-40 hidden"></div>
    
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-72 bg-[#121212] min-h-screen flex flex-col fixed lg:relative z-50 transition-transform duration-300">
        <!-- Logo section -->
        <div class="flex items-center justify-between p-5 border-b border-[#2D2D2D]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange to-orange-dark rounded-xl flex items-center justify-center shadow-lg shadow-orange/20">
                    <i class="fas fa-truck-fast text-white text-lg"></i>
                </div>
                <div>
                    <div class="text-white font-bold text-lg tracking-tight">GoLivreur</div>
                    <div class="text-grey text-xs">Administration</div>
                </div>
            </div>
            <button id="closeSidebarBtn" class="lg:hidden text-grey hover:text-orange transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
            <div class="text-grey text-xs uppercase tracking-wider px-3 mb-3 text-[10px]">Principal</div>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line w-5 text-orange"></i>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Utilisateurs</div>
            
            <a href="{{ route('admin.clients.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <i class="fas fa-users w-5"></i>
                <span class="text-sm font-medium">Clients</span>
            </a>
            
            <a href="{{ route('admin.commercants.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.commercants.*') ? 'active' : '' }}">
                <i class="fas fa-store w-5"></i>
                <span class="text-sm font-medium">Commerçants</span>
                <span class="ml-auto text-xs bg-orange/20 text-orange px-2 py-0.5 rounded-full">Attente</span>
            </a>
            
            <a href="{{ route('admin.livreurs.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.livreurs.*') ? 'active' : '' }}">
                <i class="fas fa-motorcycle w-5"></i>
                <span class="text-sm font-medium">Livreurs</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Commandes</div>
            
            <a href="{{ route('admin.commandes.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart w-5"></i>
                <span class="text-sm font-medium">Commandes</span>
            </a>
            
            <a href="{{ route('admin.colis.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.colis.*') ? 'active' : '' }}">
                <i class="fas fa-box w-5"></i>
                <span class="text-sm font-medium">Colis</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Gestion</div>
            
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags w-5"></i>
                <span class="text-sm font-medium">Catégories</span>
            </a>
            
            <a href="{{ route('admin.codes-promo.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.codes-promo.*') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt w-5"></i>
                <span class="text-sm font-medium">Codes Promo</span>
            </a>
            
            <a href="{{ route('admin.parametres.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.parametres.*') ? 'active' : '' }}">
                <i class="fas fa-sliders-h w-5"></i>
                <span class="text-sm font-medium">Paramètres</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Finances</div>
            
            <a href="{{ route('admin.transactions.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <i class="fas fa-coins w-5"></i>
                <span class="text-sm font-medium">Transactions</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Modération</div>
            
            <a href="{{ route('admin.avis.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.avis.*') ? 'active' : '' }}">
                <i class="fas fa-star w-5"></i>
                <span class="text-sm font-medium">Avis</span>
            </a>
            
            <a href="{{ route('admin.signalements.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.signalements.*') ? 'active' : '' }}">
                <i class="fas fa-flag w-5"></i>
                <span class="text-sm font-medium">Signalements</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Personnalisation</div>
            
            <a href="{{ route('admin.zones.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.zones.*') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt w-5"></i>
                <span class="text-sm font-medium">Zones</span>
            </a>
            
            <a href="{{ route('admin.bannieres.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.bannieres.*') ? 'active' : '' }}">
                <i class="fas fa-images w-5"></i>
                <span class="text-sm font-medium">Bannières</span>
            </a>
            
            <a href="{{ route('admin.notifications.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                <i class="fas fa-bell w-5"></i>
                <span class="text-sm font-medium">Notifications</span>
            </a>
            
            <div class="text-grey text-xs uppercase tracking-wider px-3 mt-4 mb-3 text-[10px]">Outils</div>
            
            <a href="{{ route('admin.exports.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.exports.*') ? 'active' : '' }}">
                <i class="fas fa-download w-5"></i>
                <span class="text-sm font-medium">Exports</span>
            </a>
            
            <a href="{{ route('admin.logs.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                <i class="fas fa-history w-5"></i>
                <span class="text-sm font-medium">Logs</span>
            </a>
            
            @if(auth('admin')->user()->hasPermission('roles'))
                <a href="{{ route('admin.roles.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="fas fa-key w-5"></i>
                    <span class="text-sm font-medium">Rôles</span>
                </a>
            @endif

            @if(auth('admin')->user()->hasPermission('admins'))
                <a href="{{ route('admin.admins.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-grey transition-all {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield w-5"></i>
                    <span class="text-sm font-medium">Administrateurs</span>
                </a>
            @endif
        </nav>

        <!-- User section -->
        <div class="border-t border-[#2D2D2D] pt-4 pb-6 px-4 mt-auto">
            <div class="relative group">
                <button id="userMenuBtn" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-[#1E1E1E] transition-all">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange to-orange-dark rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-sm font-bold">
                            {{ substr(auth('admin')->user()->nom, 0, 1) }}{{ substr(auth('admin')->user()->prenom, 0, 1) }}
                        </span>
                    </div>
                    <div class="flex-1 text-left">
                        <div class="text-white text-sm font-semibold truncate">{{ auth('admin')->user()->nom }} {{ auth('admin')->user()->prenom }}</div>
                        <div class="text-grey text-xs capitalize">{{ str_replace('_', ' ', auth('admin')->user()->role_admin) }}</div>
                    </div>
                    <i class="fas fa-chevron-down text-grey text-xs transition-transform group-hover:rotate-180"></i>
                </button>
                
                <!-- Dropdown menu -->
                <div id="userDropdown" class="absolute bottom-full left-0 right-0 mb-2 bg-[#1E1E1E] rounded-xl border border-[#2D2D2D] overflow-hidden hidden">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-[#2D2D2D] transition-colors">
                        <i class="fas fa-user text-grey w-5"></i>
                        <span class="text-sm text-white">Mon profil</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-[#2D2D2D] transition-colors">
                        <i class="fas fa-lock text-grey w-5"></i>
                        <span class="text-sm text-white">Changer mot de passe</span>
                    </a>
                    <hr class="border-[#2D2D2D]">
                    <form method="POST" action="{{ route('admin.logout') }}" id="logoutForm">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-500/10 transition-colors">
                            <i class="fas fa-sign-out-alt text-red-500 w-5"></i>
                            <span class="text-sm text-red-500">Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 min-h-screen overflow-y-auto transition-all duration-300 lg:ml-72">
        <!-- Top bar -->
        <div class="sticky top-0 z-30 bg-[#0A0A0A]/95 backdrop-blur-md border-b border-[#2D2D2D] px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button id="openSidebarBtn" class="lg:hidden text-white text-xl hover:text-orange transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="hidden lg:block">
                        <h1 class="text-white font-semibold text-lg">@yield('header', 'Dashboard')</h1>
                        <p class="text-grey text-xs">@yield('subtitle', 'Bienvenue sur votre espace d\'administration')</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-grey text-sm"></i>
                        <input type="text" id="globalSearch" placeholder="Rechercher..." class="bg-[#1E1E1E] border border-[#2D2D2D] rounded-xl pl-10 pr-4 py-2 text-sm text-white placeholder-grey focus:border-orange focus:outline-none transition-colors w-64">
                    </div>
                    
                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notificationsBtn" class="relative w-10 h-10 rounded-xl bg-[#1E1E1E] hover:bg-[#2D2D2D] transition-colors flex items-center justify-center">
                            <i class="fas fa-bell text-grey text-lg"></i>
                            <span class="notification-badge hidden">3</span>
                        </button>
                        
                        <!-- Notifications dropdown -->
                        <div id="notificationsDropdown" class="absolute right-0 top-full mt-2 w-80 bg-[#121212] rounded-xl border border-[#2D2D2D] shadow-2xl hidden">
                            <div class="p-3 border-b border-[#2D2D2D] flex justify-between items-center">
                                <span class="text-white font-semibold text-sm">Notifications</span>
                                <button class="text-grey text-xs hover:text-orange">Tout marquer lu</button>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <div class="p-3 hover:bg-[#1E1E1E] transition-colors border-b border-[#2D2D2D]">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 bg-orange/20 rounded-full flex items-center justify-center">
                                            <i class="fas fa-shopping-cart text-orange text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-white text-xs">Nouvelle commande #1234</p>
                                            <p class="text-grey text-[10px]">Il y a 5 minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 hover:bg-[#1E1E1E] transition-colors border-b border-[#2D2D2D]">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                                            <i class="fas fa-check text-green-500 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-white text-xs">Livreur inscrit - Issa Ouattara</p>
                                            <p class="text-grey text-[10px]">Il y a 15 minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 text-center">
                                    <a href="{{ route('admin.notifications.index') }}" class="text-orange text-xs hover:underline">Voir toutes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Date/Time -->
                    <div class="hidden lg:block text-right">
                        <div class="text-white text-sm font-medium" id="currentTime"></div>
                        <div class="text-grey text-[10px]" id="currentDate"></div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile page title -->
            <div class="lg:hidden mt-3">
                <h1 class="text-white font-semibold text-lg">@yield('header', 'Dashboard')</h1>
                <p class="text-grey text-xs">@yield('subtitle', 'Bienvenue sur votre espace d\'administration')</p>
            </div>
        </div>

        <!-- Flash messages -->
        <div class="px-6 pt-6 space-y-3">
            @if(session('success'))
                <div class="bg-green-500/10 border-l-4 border-green-500 text-green-500 p-4 rounded-r-xl text-sm flex items-center gap-3 animate-fade-in">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-green-500/50 hover:text-green-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-500/10 border-l-4 border-red-500 text-red-500 p-4 rounded-r-xl text-sm flex items-center gap-3 animate-fade-in">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-red-500/50 hover:text-red-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            @if(session('warning'))
                <div class="bg-yellow-500/10 border-l-4 border-yellow-500 text-yellow-500 p-4 rounded-r-xl text-sm flex items-center gap-3 animate-fade-in">
                    <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                    <span>{{ session('warning') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-yellow-500/50 hover:text-yellow-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- Page content -->
        <div class="p-6 animate-fade-in">
            @yield('content')
        </div>
    </main>

    <script>
        // Sidebar mobile toggle
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const overlay = document.getElementById('sidebarOverlay');
        
        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }
        
        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
        
        // User dropdown
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userMenuBtn && userDropdown) {
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (e) => {
                if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
        
        // Notifications dropdown
        const notificationsBtn = document.getElementById('notificationsBtn');
        const notificationsDropdown = document.getElementById('notificationsDropdown');
        
        if (notificationsBtn && notificationsDropdown) {
            notificationsBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                notificationsDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (e) => {
                if (!notificationsBtn.contains(e.target) && !notificationsDropdown.contains(e.target)) {
                    notificationsDropdown.classList.add('hidden');
                }
            });
        }
        
        // Date/Time display
        function updateDateTime() {
            const now = new Date();
            const timeElement = document.getElementById('currentTime');
            const dateElement = document.getElementById('currentDate');
            
            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            }
            if (dateElement) {
                dateElement.textContent = now.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
            }
        }
        
        updateDateTime();
        setInterval(updateDateTime, 60000);
        
        // Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.animate-fade-in').forEach(el => {
                setTimeout(() => {
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 300);
                }, 4500);
            });
        }, 500);
        
        // Global search
        const globalSearch = document.getElementById('globalSearch');
        if (globalSearch) {
            let searchTimeout;
            globalSearch.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = e.target.value;
                    if (searchTerm.length > 2) {
                        // Dispatch custom event for pages to listen to
                        window.dispatchEvent(new CustomEvent('globalSearch', { detail: searchTerm }));
                    }
                }, 300);
            });
        }
        
        // Active link highlight on scroll (optional)
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href) && href !== '/admin') {
                link.classList.add('active');
            } else if (href === '/admin' && currentPath === '/admin') {
                link.classList.add('active');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>