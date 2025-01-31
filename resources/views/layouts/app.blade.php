<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Stadium Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dropdown:hover .dropdown-menu {
            {{-- In the dropdown menu section --}}
<div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200">
    <a href="{{ route('bookings.index') }}" 
       class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
        My Bookings
    </a>
    <a href="{{ route('stadiums.index') }}?my_stadiums=1" 
       class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
        My Stadiums
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50">
            Log Out
        </button>
    </form>
</div>
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">StadiumBook</a>
                    <div class="hidden md:flex space-x-8 ml-10">
                        <a href="{{ route('stadiums.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Stadiums</a>
                        @auth
                            <a href="{{ route('bookings.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">My Bookings</a>
                            <a href="{{ route('stadiums.create') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Add Stadium</a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Users</a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative dropdown">
                            <button class="flex items-center space-x-1 group">
                                <span class="text-gray-600 group-hover:text-gray-900">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                    menu.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>