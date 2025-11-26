<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<nav x-data="{ 
    isOpen: false, 
    scrolled: false,
    activeMenu: null 
}" 
@scroll.window="scrolled = window.pageYOffset > 20"
:class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-lg' : 'bg-white/80 backdrop-blur-sm shadow-sm'"
class="fixed w-full top-0 z-50 transition-all duration-500">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            {{-- Logo with Animation --}}
           <div class="flex-shrink-0">
    <a href="{{ url('/') }}" class="flex items-center space-x-3">
        <img src="{{ asset('images/logo-perpusku.png') }}" 
             alt="PerpusKu Logo" 
             class="h-14 w-14 object-contain"> 
        <span class="text-2xl font-bold tracking-wide text-[#D32F2F]">
            PerpusKu
        </span>
    </a>
</div>


            {{-- Desktop Menu with Animated Underline --}}
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" 
                   @mouseenter="activeMenu = 'home'" 
                   @mouseleave="activeMenu = null"
                   class="relative px-4 py-2 text-gray-700 font-medium text-sm group">
                    <span class="relative z-10 group-hover:text-[#D32F2F] transition-colors duration-300">Home</span>
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </a>
                
                <a href="{{ route('fitur') }}" 
                   @mouseenter="activeMenu = 'fitur'" 
                   @mouseleave="activeMenu = null"
                   class="relative px-4 py-2 text-gray-700 font-medium text-sm group">
                    <span class="relative z-10 group-hover:text-[#D32F2F] transition-colors duration-300">Fitur</span>
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </a>
                
                <a href="{{ route('panduan') }}" 
                   @mouseenter="activeMenu = 'panduan'" 
                   @mouseleave="activeMenu = null"
                   class="relative px-4 py-2 text-gray-700 font-medium text-sm group">
                    <span class="relative z-10 group-hover:text-[#D32F2F] transition-colors duration-300">Panduan</span>
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </a>
                
                <a href="{{ route('testimoni') }}" 
                   @mouseenter="activeMenu = 'testimoni'" 
                   @mouseleave="activeMenu = null"
                   class="relative px-4 py-2 text-gray-700 font-medium text-sm group">
                    <span class="relative z-10 group-hover:text-[#D32F2F] transition-colors duration-300">Testimoni</span>
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </a>
                
                <a href="{{ route('partner') }}" 
                   @mouseenter="activeMenu = 'partner'" 
                   @mouseleave="activeMenu = null"
                   class="relative px-4 py-2 text-gray-700 font-medium text-sm group">
                    <span class="relative z-10 group-hover:text-[#D32F2F] transition-colors duration-300">Partner</span>
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </a>
                
                <a href="{{ route('faq') }}" 
                   @mouseenter="activeMenu = 'faq'" 
                   @mouseleave="activeMenu = null"
                   class="relative px-4 py-2 text-gray-700 font-medium text-sm group">
                    <span class="relative z-10 group-hover:text-[#D32F2F] transition-colors duration-300">FAQ</span>
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </a>
            </div>

            {{-- CTA Buttons --}}
            <div class="hidden lg:flex items-center space-x-3">
                <a href="{{ route('register') }}" 
                   class="px-5 py-2.5 text-[#D32F2F] font-medium text-sm hover:bg-red-50 rounded-xl transition-all duration-300">
                    Daftar
                </a>
                <a href="{{ route('login') }}" 
                   class="relative px-6 py-2.5 font-medium text-sm text-white rounded-xl overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#D32F2F] to-[#F44336] transition-all duration-300"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#F44336] to-[#D32F2F] opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <span class="relative flex items-center space-x-2">
                        <span>Login</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </a>
            </div>

            {{-- Mobile menu button with Animation --}}
            <div class="lg:hidden">
                <button @click="isOpen = !isOpen" 
                        class="relative p-2 rounded-xl text-gray-700 hover:bg-red-50 focus:outline-none transition-all duration-300 group">
                    <div class="w-6 h-5 relative flex flex-col justify-between">
                        <span :class="isOpen ? 'rotate-45 translate-y-2' : ''" 
                              class="w-full h-0.5 bg-gray-700 group-hover:bg-[#D32F2F] rounded-full transform transition-all duration-300 origin-center"></span>
                        <span :class="isOpen ? 'opacity-0 scale-0' : 'opacity-100 scale-100'" 
                              class="w-full h-0.5 bg-gray-700 group-hover:bg-[#D32F2F] rounded-full transform transition-all duration-300"></span>
                        <span :class="isOpen ? '-rotate-45 -translate-y-2' : ''" 
                              class="w-full h-0.5 bg-gray-700 group-hover:bg-[#D32F2F] rounded-full transform transition-all duration-300 origin-center"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu with Stagger Animation --}}
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         @click.away="isOpen = false"
         class="lg:hidden border-t border-gray-100 bg-white/95 backdrop-blur-lg">
        <div class="px-4 py-6 space-y-2 max-h-[calc(100vh-5rem)] overflow-y-auto">
            <a href="{{ route('home') }}" 
               x-show="isOpen"
               x-transition:enter="transition ease-out duration-300 delay-75"
               x-transition:enter-start="opacity-0 translate-x-4"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:text-[#D32F2F] transition-all duration-300 group">
                <div class="w-1 h-6 bg-[#D32F2F] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="font-medium">Home</span>
            </a>
            
            <a href="{{ route('fitur') }}" 
               x-show="isOpen"
               x-transition:enter="transition ease-out duration-300 delay-100"
               x-transition:enter-start="opacity-0 translate-x-4"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:text-[#D32F2F] transition-all duration-300 group">
                <div class="w-1 h-6 bg-[#D32F2F] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="font-medium">Fitur</span>
            </a>
            
            <a href="{{ route('panduan') }}" 
               x-show="isOpen"
               x-transition:enter="transition ease-out duration-300 delay-150"
               x-transition:enter-start="opacity-0 translate-x-4"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:text-[#D32F2F] transition-all duration-300 group">
                <div class="w-1 h-6 bg-[#D32F2F] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="font-medium">Panduan</span>
            </a>
            
            <a href="{{ route('testimoni') }}" 
               x-show="isOpen"
               x-transition:enter="transition ease-out duration-300 delay-200"
               x-transition:enter-start="opacity-0 translate-x-4"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:text-[#D32F2F] transition-all duration-300 group">
                <div class="w-1 h-6 bg-[#D32F2F] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="font-medium">Testimoni</span>
            </a>
            
            <a href="{{ route('partner') }}" 
               x-show="isOpen"
               x-transition:enter="transition ease-out duration-300 delay-250"
               x-transition:enter-start="opacity-0 translate-x-4"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:text-[#D32F2F] transition-all duration-300 group">
                <div class="w-1 h-6 bg-[#D32F2F] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="font-medium">Partner</span>
            </a>
            
            <a href="{{ route('faq') }}" 
               x-show="isOpen"
               x-transition:enter="transition ease-out duration-300 delay-300"
               x-transition:enter-start="opacity-0 translate-x-4"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:text-[#D32F2F] transition-all duration-300 group">
                <div class="w-1 h-6 bg-[#D32F2F] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="font-medium">FAQ</span>
            </a>

            {{-- Mobile CTA --}}
            <div x-show="isOpen"
                 x-transition:enter="transition ease-out duration-300 delay-350"
                 x-transition:enter-start="opacity-0 translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 class="pt-4 space-y-2 border-t border-gray-100 mt-4">
                <a href="{{ route('register') }}" 
                   class="block px-4 py-3 text-center text-[#D32F2F] font-medium rounded-xl border-2 border-[#D32F2F] hover:bg-red-50 transition-all duration-300">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" 
                   class="block px-4 py-3 text-center text-white font-medium rounded-xl bg-gradient-to-r from-[#D32F2F] to-[#F44336] hover:shadow-lg hover:shadow-red-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>