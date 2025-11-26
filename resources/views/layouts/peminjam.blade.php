    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'PerpusKu - Digital Library')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50">
        <!-- Top Navbar -->
       <nav class="fixed top-0 left-0 right-0 h-16 bg-white/80 backdrop-blur-md shadow-lg border-b border-red-100 z-50">
    <div class="flex items-center justify-between h-full px-4">
        
        <!-- Left Section: Logo + Brand -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-perpusku.png') }}"
     class="h-32 w-auto object-contain drop-shadow-md"
     alt="Logo PerpusKu">

        </div>

        <!-- Right Section: Profile -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center gap-3 px-2 py-1 rounded-lg hover:bg-gray-100 transition">

                @if(auth()->user()->image ?? false)
    <img src="{{ asset('storage/' . auth()->user()->image) }}"
        class="w-11 h-11 rounded-full object-cover shadow-sm">
@else
    <div class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center font-semibold text-gray-700 shadow-sm">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    </div>
@endif


                <div class="hidden lg:block text-left leading-tight">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ auth()->user()->username }}
                    </p>
                    <p class="text-[11px] text-gray-500">
                        {{ auth()->user()->role ?? 'User' }}
                    </p>
                </div>

                <svg class="w-4 h-4 text-gray-500 group-hover:text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open=false"
                class="absolute right-0 mt-2 w-44 bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden z-50"
                x-cloak>
                
                <a href="{{ route('peminjam.profile') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-red-50 transition text-gray-700">
                    <svg class="w-6 h-6 lg:w-5 lg:h-5 text-gray-400 group-hover:text-[#D32F2F] {{ request()->routeIs('peminjam.profile') ? 'text-[#D32F2F]' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                         Profil Saya
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-100 transition">
                        <svg class="w-6 h-6 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>


        <!-- Alerts Container -->
        <div id="alertsContainer" class="fixed top-20 right-4 z-50 space-y-3 max-w-md">
            @if(session('success'))
                <div class="alert-item bg-white border-l-4 border-green-500 rounded-lg shadow-lg p-4 flex items-start space-x-3 animate-slide-in">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Success!</p>
                        <p class="text-sm text-gray-600 mt-1">{{ session('success') }}</p>
                    </div>
                    <button class="close-alert flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-item bg-white border-l-4 border-red-500 rounded-lg shadow-lg p-4 flex items-start space-x-3 animate-slide-in">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Error!</p>
                        <p class="text-sm text-gray-600 mt-1">{{ session('error') }}</p>
                    </div>
                    <button class="close-alert flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-item bg-white border-l-4 border-red-500 rounded-lg shadow-lg p-4 flex items-start space-x-3 animate-slide-in">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Validation Errors!</p>
                        <ul class="text-sm text-gray-600 mt-2 space-y-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="close-alert flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Sidebar Overlay (Mobile) -->
        <div 
            id="sidebarOverlay" 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden">
        </div>

        <!-- Sidebar -->
        <aside 
            id="sidebar"
            class="fixed left-0 top-16 bottom-0 w-72 lg:w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 overflow-y-auto">
            
            <div class="flex flex-col h-full">
                <!-- Navigation Header -->
                <div class="p-5 lg:p-4 border-b border-gray-100">
                    <h2 class="text-sm lg:text-xs font-semibold text-gray-400 uppercase tracking-wider">Navigation</h2>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 p-4 lg:p-3 space-y-2 lg:space-y-1">
            <a href="{{ route('peminjam.dashboard') }}"
    class="flex items-center space-x-3 px-5 py-4 lg:px-4 lg:py-3 rounded-lg group transition-all
    {{ request()->routeIs('peminjam.dashboard') 
            ? 'bg-gray-50 text-[#D32F2F]' 
            : 'text-gray-600 hover:bg-gray-50' }}">

        <svg class="w-6 h-6 lg:w-5 lg:h-5 
            {{ request()->routeIs('peminjam.dashboard') 
                ? 'text-[#D32F2F]' 
                : 'text-gray-400 group-hover:text-[#D32F2F]' }}" 
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>

        <span class="font-medium text-base lg:text-sm">Dashboard</span>
    </a>    


                    <a href="{{ route('peminjam.books.index') }}" class="flex items-center space-x-3 px-5 py-4 lg:px-4 lg:py-3 text-gray-600 rounded-lg group hover:bg-gray-50 transition-all {{ request()->routeIs('peminjam.books.*') ? 'bg-gray-50 text-[#D32F2F]' : '' }}">
                        <svg class="w-6 h-6 lg:w-5 lg:h-5 text-gray-400 group-hover:text-[#D32F2F] {{ request()->routeIs('peminjam.books.*') ? 'text-[#D32F2F]' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="font-medium text-base lg:text-sm">Katalog Buku</span>
                    </a>

                    <a href="{{ route('peminjam.borrowings.index') }}" class="flex items-center justify-between px-5 py-4 lg:px-4 lg:py-3 text-gray-600 rounded-lg group hover:bg-gray-50 transition-all {{ request()->routeIs('peminjam.borrowings.*') ? 'bg-gray-50 text-[#D32F2F]' : '' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 lg:w-5 lg:h-5 text-gray-400 group-hover:text-[#D32F2F] {{ request()->routeIs('peminjam.borrowings.*') ? 'text-[#D32F2F]' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium text-base lg:text-sm">peminjaman Saya</span>
                        </div>
                        <span class="px-2.5 py-1 lg:px-2 lg:py-0.5 text-sm lg:text-xs font-semibold text-amber-600 bg-amber-50 rounded-full">5</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-5 py-4 lg:px-4 lg:py-3 text-gray-600 rounded-lg group hover:bg-gray-50 transition-all {{ request()->routeIs('peminjam.profile') ? 'bg-gray-50 text-[#D32F2F]' : '' }}">
                        <svg class="w-6 h-6 lg:w-5 lg:h-5 text-gray-400 group-hover:text-[#D32F2F] {{ request()->routeIs('peminjam.profile') ? 'text-[#D32F2F]' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium text-base lg:text-sm">Profil Saya</span>
                    </a>
                </nav>

                <!-- User Card & Logout -->
                <div class="p-5 lg:p-4 border-t border-gray-100 space-y-3">
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-3 lg:gap-2 mb-3">
                        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-4 lg:p-3">
                            <p class="text-sm lg:text-xs text-gray-600 mb-1">Books</p>
                            <p class="text-2xl lg:text-lg font-bold text-[#7B1F1F]">248</p>
                        </div>
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-lg p-4 lg:p-3">
                            <p class="text-sm lg:text-xs text-gray-600 mb-1">Active</p>
                            <p class="text-2xl lg:text-lg font-bold text-amber-700">32</p>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 px-5 py-4 lg:px-4 lg:py-3 bg-red-50 text-[#D32F2F] rounded-lg hover:bg-red-100 transition-all group">
                            <svg class="w-6 h-6 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="font-medium text-base lg:text-sm">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main 
            id="mainContent"
            class="pt-16 lg:ml-64 transition-all duration-300">
            <div class="p-6">
                @yield('content')
            </div>
        </main>

        

        <style>
            @keyframes slide-in {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .animate-slide-in {
                animation: slide-in 0.3s ease-out;
            }

            @keyframes fade-out {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }

            .alert-fade-out {
                animation: fade-out 0.3s ease-out forwards;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const sidebarOverlay = document.getElementById('sidebarOverlay');
                const toggleSidebar = document.getElementById('toggleSidebar');
                const toggleSidebarDesktop = document.getElementById('toggleSidebarDesktop');
                const mainContent = document.getElementById('mainContent');
                const siteFooter = document.getElementById('siteFooter');

                // Mobile toggle - hanya toggle sidebar
                toggleSidebar?.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                });

                // Desktop toggle - toggle sidebar, main content, dan footer
                toggleSidebarDesktop?.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    mainContent.classList.toggle('lg:ml-64');
                    mainContent.classList.toggle('lg:ml-0');
                    siteFooter.classList.toggle('lg:ml-64');
                    siteFooter.classList.toggle('lg:ml-0');
                });

                // Close sidebar when clicking overlay
                sidebarOverlay?.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });

                // Close sidebar on mobile when clicking a link
                const sidebarLinks = sidebar.querySelectorAll('a');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 1024) {
                            sidebar.classList.add('-translate-x-full');
                            sidebarOverlay.classList.add('hidden');
                        }
                    });
                });

                // Alert handling with animation
                const closeAlertButtons = document.querySelectorAll('.close-alert');
                closeAlertButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const alertItem = this.closest('.alert-item');
                        alertItem.classList.add('alert-fade-out');
                        setTimeout(() => {
                            alertItem.remove();
                        }, 300);
                    });
                });

                // Auto hide alerts after 5 seconds with animation
                setTimeout(() => {
                    const alerts = document.querySelectorAll('.alert-item');
                    alerts.forEach(alert => {
                        alert.classList.add('alert-fade-out');
                        setTimeout(() => {
                            alert.remove();
                        }, 300);
                    });
                }, 5000);
            });
        </script>

        @stack('scripts')
    </body>
    </html>