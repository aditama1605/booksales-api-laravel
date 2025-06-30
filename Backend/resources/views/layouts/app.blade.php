<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore App</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Optional: Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- ✅ Navbar -->
    <nav class="bg-white border-b border-gray-200 shadow-sm dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
                <span class="text-xl font-bold text-blue-600">BookStore</span>
            </a>

            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 md:hidden hover:bg-gray-100 focus:outline-none"
                aria-controls="navbar-default" aria-expanded="false">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5h14M3 10h14M3 15h14" clip-rule="evenodd" />
                </svg>
            </button>

            <div class="hidden w-full md:flex md:w-auto" id="navbar-default">
                <ul class="flex flex-col md:flex-row items-center md:space-x-8 mt-4 md:mt-0 text-sm font-medium">
                    <li><a href="{{ url('/') }}" class="hover:text-blue-600">Home</a></li>
                    <li><a href="{{ url('/books') }}" class="hover:text-blue-600">Books</a></li>
                    <li><a href="{{ url('/cart') }}" class="hover:text-blue-600">Cart</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-blue-600">About</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-blue-600">Contact</a></li>
                    @auth
                        <li>
                            <a href="{{ url('/logout') }}" class="text-red-500 hover:underline">Logout</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/login') }}" class="text-blue-600 hover:underline">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- ✅ Footer -->
    <footer class="bg-white border-t dark:bg-gray-900 dark:border-gray-700 py-6 mt-10">
        <div class="max-w-screen-xl mx-auto text-center text-sm text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} BookStore. Dibuat dengan ❤️ oleh Adi indra pratama.
        </div>
    </footer>

    <!-- Flowbite Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>

    <!-- Optional: Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
