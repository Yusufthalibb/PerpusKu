 @include('layouts.guest')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - Beranda</title>
</head>
<body>
    <div class="mt-6">
   <section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-gray-50 via-white to-red-50">
    
    {{-- Animated Background Shapes --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        {{-- Gradient Orbs --}}
        <div class="absolute top-20 -left-20 w-72 h-72 bg-gradient-to-br from-[#D32F2F]/20 to-[#F44336]/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 -right-32 w-96 h-96 bg-gradient-to-bl from-[#F44336]/15 to-[#D32F2F]/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute -bottom-20 left-1/3 w-80 h-80 bg-gradient-to-tr from-[#D32F2F]/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        
        {{-- Floating Books SVG --}}
        <div class="absolute top-32 right-20 opacity-10 animate-float">
            <svg class="w-24 h-24 text-[#D32F2F]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 2L14 6.5V17.5L19 13V2M6.5 5C4.55 5 2.45 5.4 1 6.5V21.16C1 21.41 1.25 21.66 1.5 21.66C1.6 21.66 1.65 21.59 1.75 21.59C3.1 20.94 5.05 20.5 6.5 20.5C8.45 20.5 10.55 20.9 12 22C13.35 21.15 15.8 20.5 17.5 20.5C19.15 20.5 20.85 20.81 22.25 21.56C22.35 21.61 22.4 21.59 22.5 21.59C22.75 21.59 23 21.34 23 21.09V6.5C22.4 6.05 21.75 5.75 21 5.5V19C19.9 18.65 18.7 18.5 17.5 18.5C15.8 18.5 13.35 19.15 12 20V6.5C10.55 5.4 8.45 5 6.5 5Z"/>
            </svg>
        </div>
        <div class="absolute bottom-40 left-16 opacity-10 animate-float" style="animation-delay: 1.5s;">
            <svg class="w-20 h-20 text-[#D32F2F]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 2L14 6.5V17.5L19 13V2M6.5 5C4.55 5 2.45 5.4 1 6.5V21.16C1 21.41 1.25 21.66 1.5 21.66C1.6 21.66 1.65 21.59 1.75 21.59C3.1 20.94 5.05 20.5 6.5 20.5C8.45 20.5 10.55 20.9 12 22C13.35 21.15 15.8 20.5 17.5 20.5C19.15 20.5 20.85 20.81 22.25 21.56C22.35 21.61 22.4 21.59 22.5 21.59C22.75 21.59 23 21.34 23 21.09V6.5C22.4 6.05 21.75 5.75 21 5.5V19C19.9 18.65 18.7 18.5 17.5 18.5C15.8 18.5 13.35 19.15 12 20V6.5C10.55 5.4 8.45 5 6.5 5Z"/>
            </svg>
        </div>
        
        {{-- Geometric Patterns --}}
        <div class="absolute top-1/4 right-1/4 w-32 h-32 border-2 border-[#D32F2F]/10 rounded-lg rotate-45 animate-spin-slow"></div>
        <div class="absolute bottom-1/3 left-1/4 w-24 h-24 border-2 border-[#F44336]/10 rounded-full animate-ping-slow"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- Left Content --}}
            <div class="text-center lg:text-left space-y-8" 
                 x-data="{ show: false }" 
                 x-init="setTimeout(() => show = true, 100)">
                
                {{-- Badge --}}
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-red-50 to-orange-50 border border-[#D32F2F]/20 rounded-full">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#D32F2F] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#D32F2F]"></span>
                    </span>
                    <span class="text-sm font-medium text-[#D32F2F]">Platform Perpustakaan Digital Terpercaya</span>
                </div>

                {{-- Main Title --}}
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-100"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h1 class="text-5xl sm:text-6xl lg:text-6xl font-extrabold leading-tight">
                        <span class="block text-gray-900">Selamat Datang Di</span>
                        <span class="block mt-2 bg-gradient-to-r from-[#D32F2F] via-[#F44336] to-[#D32F2F] bg-clip-text text-transparent animate-gradient">
                            PerpusKu
                        </span>
                    </h1>
                </div>

                {{-- Subtitle --}}
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-200"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <p class="text-lg sm:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Cari buku yang Anda butuhkan dan ajukan peminjaman hanya dalam beberapa klik. 
                        PerpusKu membuat proses peminjaman perpustakaan menjadi lebih cepat, rapi, dan terorganisir.
                    </p>
                </div>

                {{-- Features Pills --}}
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-300"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="flex flex-wrap gap-3 justify-center lg:justify-start">
                    <div class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">10.000+ Koleksi</span>
                    </div>
                    <div class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Akses 24/7</span>
                    </div>
                    <div class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">100% Gratis</span>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-400"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    
                    <a href="{{ route('register') }}" 
                       class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#D32F2F] to-[#F44336]"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#F44336] to-[#D32F2F] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="relative flex items-center space-x-2">
                            <span>Daftar Sekarang</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </a>

                    <a href="{{ route('login') }}" 
                       class="group inline-flex items-center justify-center px-8 py-4 font-bold text-[#D32F2F] bg-white border-2 border-[#D32F2F] rounded-2xl hover:bg-red-50 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <span class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Login</span>
                        </span>
                    </a>
                </div>

                {{-- Stats --}}
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-500"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-[#D32F2F]">15K+</div>
                        <div class="text-sm text-gray-600 mt-1">Pengguna Aktif</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-[#D32F2F]">50K+</div>
                        <div class="text-sm text-gray-600 mt-1">Buku Dipinjam</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-[#D32F2F]">4.9★</div>
                        <div class="text-sm text-gray-600 mt-1">Rating User</div>
                    </div>
                </div>
            </div>

            {{-- Right Illustration --}}
            <div class="relative hidden lg:block"
                 x-data="{ show: false }" 
                 x-init="setTimeout(() => show = true, 300)">
                
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     class="relative">
                    
                    {{-- Main Illustration Container --}}
                    <div class="relative z-10">
                        {{-- Book Stack SVG Illustration --}}
                        <div class="relative w-full h-[600px] flex items-center justify-center">
                            
                            {{-- Background Circle --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-96 h-96 bg-gradient-to-br from-[#D32F2F]/10 to-[#F44336]/5 rounded-full blur-3xl animate-pulse"></div>
                            </div>
                            
                            {{-- Books Illustration --}}
                            <div class="relative z-10 space-y-4">
                                {{-- Book 1 --}}
                                <div class="transform hover:scale-105 transition-transform duration-300 animate-float">
                                    <div class="w-64 h-20 bg-gradient-to-r from-[#D32F2F] to-[#F44336] rounded-lg shadow-2xl p-4 flex items-center space-x-3">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 2L14 6.5V17.5L19 13V2M6.5 5C4.55 5 2.45 5.4 1 6.5V21.16C1 21.41 1.25 21.66 1.5 21.66C1.6 21.66 1.65 21.59 1.75 21.59C3.1 20.94 5.05 20.5 6.5 20.5C8.45 20.5 10.55 20.9 12 22C13.35 21.15 15.8 20.5 17.5 20.5C19.15 20.5 20.85 20.81 22.25 21.56C22.35 21.61 22.4 21.59 22.5 21.59C22.75 21.59 23 21.34 23 21.09V6.5C22.4 6.05 21.75 5.75 21 5.5V19C19.9 18.65 18.7 18.5 17.5 18.5C15.8 18.5 13.35 19.15 12 20V6.5C10.55 5.4 8.45 5 6.5 5Z"/>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="h-2 bg-white/30 rounded w-3/4 mb-2"></div>
                                            <div class="h-2 bg-white/20 rounded w-1/2"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Book 2 --}}
                                <div class="transform hover:scale-105 transition-transform duration-300 animate-float" style="animation-delay: 0.5s;">
                                    <div class="w-64 h-20 bg-gradient-to-r from-[#F44336] to-[#E91E63] rounded-lg shadow-2xl p-4 flex items-center space-x-3 ml-8">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 2L14 6.5V17.5L19 13V2M6.5 5C4.55 5 2.45 5.4 1 6.5V21.16C1 21.41 1.25 21.66 1.5 21.66C1.6 21.66 1.65 21.59 1.75 21.59C3.1 20.94 5.05 20.5 6.5 20.5C8.45 20.5 10.55 20.9 12 22C13.35 21.15 15.8 20.5 17.5 20.5C19.15 20.5 20.85 20.81 22.25 21.56C22.35 21.61 22.4 21.59 22.5 21.59C22.75 21.59 23 21.34 23 21.09V6.5C22.4 6.05 21.75 5.75 21 5.5V19C19.9 18.65 18.7 18.5 17.5 18.5C15.8 18.5 13.35 19.15 12 20V6.5C10.55 5.4 8.45 5 6.5 5Z"/>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="h-2 bg-white/30 rounded w-3/4 mb-2"></div>
                                            <div class="h-2 bg-white/20 rounded w-1/2"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Book 3 --}}
                                <div class="transform hover:scale-105 transition-transform duration-300 animate-float" style="animation-delay: 1s;">
                                    <div class="w-64 h-20 bg-gradient-to-r from-[#E91E63] to-[#D32F2F] rounded-lg shadow-2xl p-4 flex items-center space-x-3">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 2L14 6.5V17.5L19 13V2M6.5 5C4.55 5 2.45 5.4 1 6.5V21.16C1 21.41 1.25 21.66 1.5 21.66C1.6 21.66 1.65 21.59 1.75 21.59C3.1 20.94 5.05 20.5 6.5 20.5C8.45 20.5 10.55 20.9 12 22C13.35 21.15 15.8 20.5 17.5 20.5C19.15 20.5 20.85 20.81 22.25 21.56C22.35 21.61 22.4 21.59 22.5 21.59C22.75 21.59 23 21.34 23 21.09V6.5C22.4 6.05 21.75 5.75 21 5.5V19C19.9 18.65 18.7 18.5 17.5 18.5C15.8 18.5 13.35 19.15 12 20V6.5C10.55 5.4 8.45 5 6.5 5Z"/>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="h-2 bg-white/30 rounded w-3/4 mb-2"></div>
                                            <div class="h-2 bg-white/20 rounded w-1/2"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Floating Icons --}}
                                <div class="absolute -top-10 -right-10 animate-bounce">
                                    <div class="w-16 h-16 bg-white rounded-full shadow-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="absolute -bottom-10 -left-10 animate-bounce" style="animation-delay: 1s;">
                                    <div class="w-16 h-16 bg-white rounded-full shadow-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</section>
<section class="relative py-20 lg:py-32 overflow-hidden bg-gradient-to-b from-white via-gray-50 to-white">
    
    {{-- Background Decorations --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-40 -right-40 w-96 h-96 bg-gradient-to-br from-[#D32F2F]/5 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-[#F44336]/5 to-transparent rounded-full blur-3xl"></div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, #D32F2F 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center mb-16 lg:mb-20" 
             x-data="{ show: false }" 
             x-intersect="show = true">
            
            {{-- Badge --}}
            <div 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-red-50 to-orange-50 border border-[#D32F2F]/20 rounded-full mb-6">
                <svg class="w-4 h-4 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-sm font-medium text-[#D32F2F]">Fitur Unggulan</span>
            </div>

            {{-- Title --}}
            <div 
                 x-transition:enter="transition ease-out duration-700 delay-100"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6">
                    Fitur <span class="bg-gradient-to-r from-[#D32F2F] to-[#F44336] bg-clip-text text-transparent">Utama</span>
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Kelola perpustakaan digital Anda dengan mudah menggunakan fitur-fitur canggih yang dirancang khusus untuk efisiensi maksimal
                </p>
            </div>
        </div>

        {{-- Features Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8"
             x-data="{ show: false }" 
             x-intersect="show = true">
            
            {{-- Feature Card 1: Manajemen Buku --}}
            <div 
                 x-transition:enter="transition ease-out duration-700 delay-200"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-[#D32F2F]/20 transform hover:-translate-y-2">
                
                {{-- Gradient Background on Hover --}}
                <div class="absolute inset-0 bg-gradient-to-br from-[#D32F2F]/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    {{-- Icon Container --}}
                    <div class="mb-6">
                        <div class="relative inline-flex">
                            {{-- Glow Effect --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-[#D32F2F] to-[#F44336] rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Icon Background --}}
                            <div class="relative bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-8 h-8 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Content --}}
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#D32F2F] transition-colors duration-300">
                        Manajemen Buku
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Kelola katalog buku digital dengan sistem yang terorganisir. Tambah, edit, dan kategorikan buku dengan mudah dan cepat.
                    </p>

                    {{-- Features List --}}
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Kategorisasi otomatis
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Pencarian advanced
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Bulk upload
                        </li>
                    </ul>

                    {{-- Learn More Link --}}
                    <a href="#" class="inline-flex items-center text-[#D32F2F] font-semibold group-hover:gap-2 transition-all duration-300">
                        <span>Pelajari Lebih</span>
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Decorative Element --}}
                <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#D32F2F]/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>

            {{-- Feature Card 2: Peminjaman Cepat --}}
            <div 
                 x-transition:enter="transition ease-out duration-700 delay-300"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-[#D32F2F]/20 transform hover:-translate-y-2">
                
                <div class="absolute inset-0 bg-gradient-to-br from-[#D32F2F]/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="mb-6">
                        <div class="relative inline-flex">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#D32F2F] to-[#F44336] rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-8 h-8 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#D32F2F] transition-colors duration-300">
                        Peminjaman Cepat
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Proses peminjaman buku dalam hitungan detik. Sistem otomatis yang terintegrasi untuk kemudahan transaksi.
                    </p>

                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            QR Code scanning
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Notifikasi real-time
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Auto reminder
                        </li>
                    </ul>

                    <a href="#" class="inline-flex items-center text-[#D32F2F] font-semibold group-hover:gap-2 transition-all duration-300">
                        <span>Pelajari Lebih</span>
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#D32F2F]/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>

            {{-- Feature Card 3: Dashboard Admin Modern --}}
            <div 
                 x-transition:enter="transition ease-out duration-700 delay-400"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-[#D32F2F]/20 transform hover:-translate-y-2">
                
                <div class="absolute inset-0 bg-gradient-to-br from-[#D32F2F]/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="mb-6">
                        <div class="relative inline-flex">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#D32F2F] to-[#F44336] rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-8 h-8 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#D32F2F] transition-colors duration-300">
                        Dashboard Admin Modern
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Interface admin yang intuitif dengan visualisasi data lengkap. Monitor semua aktivitas perpustakaan dalam satu tempat.
                    </p>

                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Analytics real-time
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Custom reports
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            User management
                        </li>
                    </ul>

                    <a href="#" class="inline-flex items-center text-[#D32F2F] font-semibold group-hover:gap-2 transition-all duration-300">
                        <span>Pelajari Lebih</span>
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#D32F2F]/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>

            {{-- Feature Card 4: Riwayat Transaksi --}}
            <div 
                 x-transition:enter="transition ease-out duration-700 delay-500"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-[#D32F2F]/20 transform hover:-translate-y-2">
                
                <div class="absolute inset-0 bg-gradient-to-br from-[#D32F2F]/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10">
                    <div class="mb-6">
                        <div class="relative inline-flex">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#D32F2F] to-[#F44336] rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-8 h-8 text-[#D32F2F]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#D32F2F] transition-colors duration-300">
                        Riwayat Transaksi
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Lacak seluruh aktivitas peminjaman dan pengembalian. Export data transaksi dengan format yang fleksibel.
                    </p>

                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Filter advanced
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Export to Excel/PDF
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-[#D32F2F] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Audit trail
                        </li>
                    </ul>

                    <a href="#" class="inline-flex items-center text-[#D32F2F] font-semibold group-hover:gap-2 transition-all duration-300">
                        <span>Pelajari Lebih</span>
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#D32F2F]/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-16 text-center"
             x-data="{ show: false }" 
             x-intersect="show = true">
            <div 
                 x-transition:enter="transition ease-out duration-700 delay-600"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <a href="{{ route('fitur') }}" 
                   class="inline-flex items-center space-x-2 px-8 py-4 bg-gradient-to-r from-[#D32F2F] to-[#F44336] text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 group">
                    <span>Lihat Semua Fitur</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <!-- Section Statistik PerpusKu -->
<div class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <h2 class="text-4xl font-bold text-gray-900 mb-3" 
                x-show="show" 
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
                Statistik PerpusKu
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto"
               x-show="show"
               x-transition:enter="transition ease-out duration-500 delay-100"
               x-transition:enter-start="opacity-0 translate-y-4"
               x-transition:enter-end="opacity-100 translate-y-0">
                Perpustakaan digital yang terus berkembang untuk kebutuhan literasi Anda
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" 
             x-data="{ 
                 stats: [
                     { number: 1200, suffix: '+', label: 'Koleksi Buku', icon: 'book', delay: 0 },
                     { number: 300, suffix: '+', label: 'Anggota Aktif', icon: 'users', delay: 100 },
                     { number: 150, suffix: '+', label: 'Peminjaman/Minggu', icon: 'activity', delay: 200 }
                 ]
             }">
            <!-- Stat Card 1 -->
            <template x-for="(stat, index) in stats" :key="index">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border border-gray-100 hover:-translate-y-2"
                     x-data="{ show: false, count: 0 }"
                     x-init="setTimeout(() => { 
                         show = true; 
                         let increment = stat.number / 50;
                         let interval = setInterval(() => {
                             if (count < stat.number) {
                                 count = Math.min(count + increment, stat.number);
                             } else {
                                 clearInterval(interval);
                                 count = stat.number;
                             }
                         }, 30);
                     }, stat.delay)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    
                    <!-- Icon Container -->
                    <div class="flex justify-center mb-6">
                        <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center">
                            <!-- Book Icon -->
                            <template x-if="stat.icon === 'book'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </template>
                            <!-- Users Icon -->
                            <template x-if="stat.icon === 'users'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </template>
                            <!-- Activity Icon -->
                            <template x-if="stat.icon === 'activity'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </template>
                        </div>
                    </div>

                    <!-- Number -->
                    <div class="text-center">
                        <h3 class="text-5xl font-bold mb-2" style="color: #D32F2F;">
                            <span x-text="Math.floor(count)"></span><span x-text="stat.suffix"></span>
                        </h3>
                        <p class="text-gray-600 text-lg font-medium" x-text="stat.label"></p>
                    </div>

                    <!-- Decorative Line -->
                    <div class="mt-6 h-1 w-16 mx-auto bg-gradient-to-r from-red-600 to-red-400 rounded-full"></div>
                </div>
            </template>
        </div>

        <!-- Additional Info -->
        <div class="mt-12 text-center" 
             x-data="{ show: false }" 
             x-init="setTimeout(() => show = true, 600)">
            <p class="text-gray-500 text-sm"
               x-show="show"
               x-transition:enter="transition ease-out duration-500"
               x-transition:enter-start="opacity-0"
               x-transition:enter-end="opacity-100">
                Data diperbarui secara real-time • Terakhir update: <span class="font-semibold">{{ date('d M Y') }}</span>
            </p>
        </div>
    </div>
</div>
</section>

</div>


{{-- Custom Animations --}}
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes ping-slow {
        75%, 100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }
    
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-spin-slow {
        animation: spin-slow 20s linear infinite;
    }
    
    .animate-ping-slow {
        animation: ping-slow 3s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    
    .animate-gradient {
        background-size: 200% auto;
        animation: gradient 3s ease infinite;
    }
</style>
</body>
</html>