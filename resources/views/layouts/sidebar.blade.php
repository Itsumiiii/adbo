<div class="flex flex-col w-64 h-screen bg-primary border-r border-secondary fixed left-0 top-0 z-50 transition-transform duration-300 transform"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full">
    
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 shadow-md bg-primary border-b border-secondary">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <x-application-logo class="w-10 h-10 text-white fill-current" />
            <span class="text-white text-xl font-bold tracking-wider">PUSTAKA</span>
        </a>
    </div>

    <!-- Navigation List -->
    <div class="flex-1 py-6 overflow-y-auto bg-primary">
        <nav class="px-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-cream/70 uppercase tracking-wider">Menu Utama</p>
            </div>

            <!-- Buku -->
            <a href="{{ route('buku.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('buku.*') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Manajemen Buku
            </a>

            <!-- Anggota -->
            <a href="{{ route('anggota.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('anggota.*') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Anggota
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-cream/70 uppercase tracking-wider">Transaksi</p>
            </div>

            <!-- Peminjaman -->
            <a href="{{ route('peminjaman.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('peminjaman.*') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Peminjaman
            </a>

            <!-- Pengembalian -->
            <a href="{{ route('pengembalian.index') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('pengembalian.*') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pengembalian
            </a>

             <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-cream/70 uppercase tracking-wider">Laporan</p>
            </div>
             <!-- Laporan Peminjaman -->
            <a href="{{ route('laporan.peminjaman') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('laporan.peminjaman') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Laporan Pinjam
            </a>
            
             <!-- Laporan Denda -->
            <a href="{{ route('laporan.denda') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('laporan.denda') ? 'bg-secondary text-white shadow-lg' : 'text-cream hover:bg-secondary/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Laporan Denda
            </a>


        </nav>
    </div>

    <!-- User Profile Link (Bottom) -->
    <div class="p-4 border-t border-secondary bg-primary">
        <a href="{{ route('profile.edit') }}" class="flex items-center w-full p-3 rounded-lg hover:bg-secondary/50 transition-colors duration-200">
             <div class="w-8 h-8 rounded-full bg-cream text-primary flex items-center justify-center font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                <p class="text-xs text-cream/70">View Profile</p>
            </div>
        </a>
         <!-- Logout -->
         <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-sm text-red-200 hover:bg-red-500/20 hover:text-red-100 rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
            </button>
        </form>
    </div>
</div>
