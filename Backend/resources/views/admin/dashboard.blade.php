<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Toko Buku Tama</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg min-h-screen hidden md:block">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-blue-600">Admin Panel</h2>
        </div>
        <nav class="p-6">
            <ul class="space-y-4">
                <li>
                    <a href="{{ url('/admin/dashboard') }}"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('/admin/books') }}"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Buku</a>
                </li>

                <li>
                    <a href="{{ url('/admin/users') }}"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pengguna</a>
                </li>
                <li>
                    <a href="{{ url('/admin/categories') }}"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Categori</a>
                </li>
                <li>
                    <a href="{{ url('/admin/orders') }}"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pesanan</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">📊 Admin Dashboard</h1>

        <!-- Grid Info Box -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-sm font-medium text-gray-500 mb-2">Total Buku</h2>
                <p class="text-2xl font-bold text-blue-600">{{ $bookCount ?? 0 }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-sm font-medium text-gray-500 mb-2">Total Pengguna</h2>
                <p class="text-2xl font-bold text-green-600">{{ $userCount ?? 0 }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-sm font-medium text-gray-500 mb-2">Total Order</h2>
                <p class="text-2xl font-bold text-purple-600">{{ $orderCount ?? 0 }}</p>
            </div>


        </div>

        <!-- Grafik dummy -->

    </main>

</body>

</html>
