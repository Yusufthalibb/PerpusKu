<div>
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik PerpusKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-6xl w-full">
        <!-- Header Section -->
        <div class="text-center mb-16" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-3 transition-all duration-700"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4'">
                Statistik PerpusKu
            </h1>
            <p class="text-gray-600 text-lg transition-all duration-700 delay-100"
               :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4'">
                Berkembang bersama komunitas pembaca
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" 
             x-data="{ 
                 books: 0, 
                 members: 0, 
                 loans: 0,
                 visible: false,
                 init() {
                     setTimeout(() => this.visible = true, 200);
                     this.animateNumber('books', 1200, 2000);
                     this.animateNumber('members', 300, 2000);
                     this.animateNumber('loans', 150, 2000);
                 },
                 animateNumber(prop, target, duration) {
                     const start = 0;
                     const increment = target / (duration / 16);
                     const timer = setInterval(() => {
                         if (this[prop] < target) {
                             this[prop] = Math.min(this[prop] + increment, target);
                         } else {
                             this[prop] = target;
                             clearInterval(timer);
                         }
                     }, 16);
                 }
             }"
             x-init="init()">
            
            <!-- Stat Card 1: Buku -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 transform hover:-translate-y-2"
                 x-show="visible"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-red-50 p-3 rounded-xl">
                        <i data-lucide="book-open" class="text-[#D32F2F] w-8 h-8"></i>
                    </div>
                </div>
                <div class="counter">
                    <h3 class="text-5xl font-bold text-[#D32F2F] mb-2" x-text="Math.floor(books) + '+'"></h3>
                    <p class="text-gray-600 text-lg font-medium">Koleksi Buku</p>
                    <p class="text-gray-400 text-sm mt-2">Berbagai genre dan kategori</p>
                </div>
            </div>

            <!-- Stat Card 2: Anggota -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 transform hover:-translate-y-2"
                 x-show="visible"
                 x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-red-50 p-3 rounded-xl">
                        <i data-lucide="users" class="text-[#D32F2F] w-8 h-8"></i>
                    </div>
                </div>
                <div class="counter">
                    <h3 class="text-5xl font-bold text-[#D32F2F] mb-2" x-text="Math.floor(members) + '+'"></h3>
                    <p class="text-gray-600 text-lg font-medium">Anggota Aktif</p>
                    <p class="text-gray-400 text-sm mt-2">Komunitas pembaca setia</p>
                </div>
            </div>

            <!-- Stat Card 3: Peminjaman -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 transform hover:-translate-y-2"
                 x-show="visible"
                 x-transition:enter="transition ease-out duration-500 delay-200"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-red-50 p-3 rounded-xl">
                        <i data-lucide="activity" class="text-[#D32F2F] w-8 h-8"></i>
                    </div>
                </div>
                <div class="counter">
                    <h3 class="text-5xl font-bold text-[#D32F2F] mb-2" x-text="Math.floor(loans) + '+'"></h3>
                    <p class="text-gray-600 text-lg font-medium">Peminjaman/Minggu</p>
                    <p class="text-gray-400 text-sm mt-2">Transaksi aktif setiap hari</p>
                </div>
            </div>
        </div>

        <!-- Bottom Info -->
        <div class="text-center mt-12" x-data="{ show: false }" x-init="setTimeout(() => show = true, 1000)">
            <p class="text-gray-500 transition-all duration-700"
               :class="show ? 'opacity-100' : 'opacity-0'">
                Data diperbarui secara real-time
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
</div>