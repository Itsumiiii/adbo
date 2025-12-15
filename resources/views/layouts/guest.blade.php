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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center">
                    <x-application-logo class="w-24 h-24 fill-current text-indigo-600 drop-shadow-lg" />
                    <h1 class="text-3xl font-bold text-gray-800 mt-4 tracking-tight">PUSTAKA CERDAS</h1>
                    <p class="text-gray-500 text-sm tracking-widest mt-1 uppercase">Sistem Informasi Perpustakaan</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-8 py-8 bg-white/80 backdrop-blur-md shadow-2xl overflow-hidden sm:rounded-2xl border border-white/50 relative">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-indigo-500 rounded-full opacity-10 blur-xl"></div>
                <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 bg-pink-500 rounded-full opacity-10 blur-xl"></div>
                
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
            
            <div class="mt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Pustaka Cerdas. All rights reserved.
            </div>
        </div>
    </body>
</html>
