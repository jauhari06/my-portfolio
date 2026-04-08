<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #333; border: 1px solid #0a0a0a; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</head>
<body class="bg-retro-bg text-retro-text font-mono antialiased selection:bg-white selection:text-black">

    <div data-barba="wrapper">
        <main data-barba="container" data-barba-namespace="home" class="min-h-screen p-4 md:p-8 max-w-7xl mx-auto">
            
            <nav class="flex justify-between items-center mb-12 border-b border-retro-border pb-4">
                <a href="/" class="text-xl font-bold tracking-tighter hover:bg-white hover:text-black transition-colors px-2">
                    [MY_PORTFOLIO]
                </a>
                <div class="text-xs text-gray-500">
                    STATUS: <span class="text-green-500 animate-pulse">●</span> ONLINE
                </div>
            </nav>

            @yield('content')

            <footer class="mt-20 py-8 text-center text-xs text-gray-600 border-t border-retro-border">
                &copy; 2025 // BUILT WITH LARAVEL + TALL STACK
            </footer>
        </main>
    </div>

    @stack('scripts')
</body>
</html>