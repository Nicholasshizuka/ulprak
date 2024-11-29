<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Company')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">

    <!-- Header Section -->
    <header class="absolute inset-x-0 top-0 z-50" style="background-color: yellow; color: white;">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">
                </a>
            </div>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <!-- Logout Form -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-black px-3 py-2">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-black px-3 py-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-black px-3 py-2">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </nav>
    </header>

    <br><br><br><br><br><br>
    <center>
        <main style="width: 70%;">
            @yield('content')
        </main>
    </center>
</body>
</html>
