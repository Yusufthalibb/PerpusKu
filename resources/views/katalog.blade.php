<section class="bg-white py-12 px-6 md:px-12 lg:px-24 max-w-7xl mx-auto">
  <h2 class="text-3xl font-semibold text-[#D32F2F] mb-8 text-center">Katalog Buku</h2>
  
  <p class="text-center text-gray-700 mb-10 text-lg">Silakan login untuk melihat koleksi buku kami.</p>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach (range(1, 8) as $item)
      <div 
        x-data 
        @click="window.location.href = '/login'" 
        class="cursor-pointer bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col overflow-hidden"
        role="button"
        tabindex="0"
        @keydown.enter="window.location.href = '/login'"
        aria-label="Katalog Buku, klik untuk login"
      >
        <div class="h-48 bg-[#D32F2F] flex items-center justify-center">
          {{-- Icon buku Lucide sebagai placeholder gambar --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-book w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" role="img">
            <path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path>
            <path d="M4 4.5A2.5 2.5 0 016.5 7H20v10H6.5A2.5 2.5 0 014 14.5v-10z"></path>
          </svg>
        </div>
        <div class="p-4 flex-grow flex flex-col justify-between">
          <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">Judul Buku {{ $item }}</h3>
          <p class="text-gray-600 text-sm line-clamp-2">Deskripsi singkat buku ini akan muncul di sini sebagai preview koleksi.</p>
        </div>
        <div class="p-4 border-t border-gray-100 flex justify-center">
          <button 
            class="bg-[#D32F2F] text-white px-5 py-2 rounded-md font-semibold hover:bg-red-700 transition-colors duration-300 w-full"
            @click.stop="window.location.href = '/login'"
            aria-label="Lihat Buku, klik untuk login"
          >
            Lihat Buku
          </button>
        </div>
      </div>
    @endforeach
  </div>
</section>
