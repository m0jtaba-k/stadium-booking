<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Stadium Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            z-index: 1000;
            min-width: 160px;
        }
        .show-dropdown {
            display: block !important;
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

                <div class="flex items-center">
                    @auth
                        <div class="relative">
                            <button onclick="toggleDropdown()" class="flex items-center space-x-2 px-4 py-2 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-gray-50">
                                <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            {{-- Dropdown Menu --}}
                            <div id="userDropdown" class="dropdown-content bg-white rounded-lg shadow-xl mt-2 py-2 w-48 border border-gray-200">
                                <a href="{{ route('bookings.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 text-sm font-medium">My Bookings</a>
                                <a href="{{ route('stadiums.index') }}?my_stadiums=1" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 text-sm font-medium">My Stadiums</a>
                                <div class="border-t my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-100 text-sm font-medium">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                        </div>
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
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show-dropdown');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('button')) {
                const dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show-dropdown')) {
                        openDropdown.classList.remove('show-dropdown');
                    }
                }
            }
        }
    </script>
</body>
</html>