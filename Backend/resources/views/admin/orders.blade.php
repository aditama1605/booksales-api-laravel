<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - Daftar Transaksi (JWT)</title>
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
                    <a href="/admin/dashboard"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Dashboard</a>
                </li>
                <li>
                    <a href="/admin/books" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Buku</a>
                </li>
                <li>
                    <a href="/admin/users" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pengguna</a>
                </li>
                <li>
                    <a href="/admin/categories"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Kategori</a>
                </li>
                <li>
                    <a href="/admin/orders"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded font-bold">Transaksi</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Konten -->
    <main class="flex-1 p-6 max-w-screen-xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">📦 Daftar Transaksi</h1>

        <div id="transactionGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
    </main>

    <script>
        const token = localStorage.getItem("token");
        const grid = document.getElementById("transactionGrid");

        function loadTransactions() {
            grid.innerHTML = "<p class='col-span-full'>Loading...</p>";

            fetch("/api/transactions", {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(response => {
                    console.log(response); // Debug

                    // Jika response langsung array
                    const transactions = response.data ?? response;

                    if (!Array.isArray(transactions)) {
                        throw new Error("Data transaksi bukan array");
                    }

                    grid.innerHTML = "";
                    transactions.forEach(order => {
                        const card = document.createElement("div");
                        card.className = "bg-white shadow rounded p-4";

                        // Gunakan relasi book & customer jika ada
                        const customerName = order.customer?.name ?? `ID: ${order.customer_id}`;
                        const bookTitle = order.book?.title ?? `ID: ${order.book_id}`;

                        card.innerHTML = `
                            <h3 class="text-md font-bold mb-2">#${order.order_number}</h3>
                            <p class="text-sm text-gray-600"><strong>Customer:</strong> ${customerName}</p>
                            <p class="text-sm text-gray-600"><strong>Buku:</strong> ${bookTitle}</p>
                            <p class="text-blue-600 font-bold mt-2">Rp${Number(order.total_amount).toLocaleString("id-ID")}</p>
                        `;
                        grid.appendChild(card);
                    });
                })
                .catch(err => {
                    console.error(err);
                    grid.innerHTML = "<p class='col-span-full text-red-500'>Gagal memuat data transaksi.</p>";
                });
        }

        loadTransactions();
    </script>
</body>

</html>
