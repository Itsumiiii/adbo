<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-cream text-gray-900">
        <!-- 
             x-data: 
             - sidebarOpen: controls mobile/desktop sidebar visibility. 
               We init based on window width. width >= 768 (md) ? true : false.
             - NOTE: Alpine cannot detect window width on init easily without $width helper or similar. 
               We'll default to 'false' (closed) for mobile-first approach, 
               but apply 'md:flex' classes to override unless explicitly toggled?
               Better: Use simple logic. 
               Let's default to TRUE (Open) and use CSS to hide on mobile if needed, 
               BUT user wants toggle button to work.
               Let's try: `sidebarOpen: false` and toggle it.
        -->
        <div x-data="{ sidebarOpen: window.innerWidth >= 768 }" 
             @resize.window="if (window.innerWidth >= 768) sidebarOpen = true"
             class="min-h-screen flex bg-cream">
            
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Wrapper -->
            <!-- We adjust md:ml-64 based on sidebarOpen. 
                 Actually, with standard sidebar toggles, if closed, margin should go away.
                 Alpine :class binding: {'md:ml-64': sidebarOpen, 'md:ml-0': !sidebarOpen}
            -->
            <div class="flex-1 flex flex-col transition-all duration-300"
                 :class="{'md:ml-64': sidebarOpen, 'md:ml-0': !sidebarOpen}">
                
                <!-- Top Navigation (Header) -->
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white/50 backdrop-blur-md shadow-sm z-10 sticky top-16">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                    {{ $slot }}
                </main>
            </div>

            <!-- Overlay for mobile sidebar -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden">
            </div>
        </div>
    </body>
</html>
