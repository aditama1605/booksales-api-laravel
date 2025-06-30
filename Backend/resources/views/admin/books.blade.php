<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - CRUD Buku (JWT)</title>
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
                    <a href="/admin/books" class="block text-gray-700 bg-blue-100 px-3 py-2 rounded font-bold">Buku</a>
                </li>
                <li><a href="/admin/categories"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Kategori</a></li>
                <li>
                    <a href="/admin/users" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pengguna</a>
                </li>
                <li>
                    <a href="/admin/orders" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pesanan</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 max-w-screen-xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">📚 Admin Buku (JWT)</h1>

        <!-- Form -->
        <form id="bookForm" class="bg-white p-6 rounded shadow mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="hidden" id="bookId">
            <input type="text" id="title" placeholder="Judul" class="border p-2 rounded" required>
            <input type="number" id="price" placeholder="Harga" class="border p-2 rounded" required>
            <input type="number" id="stock" placeholder="Stok" class="border p-2 rounded" required>
            <input type="text" id="cover_photo" placeholder="URL Cover" class="border p-2 rounded">
            <input type="number" id="genre_id" placeholder="Genre ID" class="border p-2 rounded" required>
            <input type="number" id="author_id" placeholder="Author ID" class="border p-2 rounded" required>
            <textarea id="description" placeholder="Deskripsi" class="border p-2 rounded md:col-span-2"></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded md:col-span-2" id="submitBtn">Tambah
                Buku</button>
        </form>

        <h2 class="text-xl font-semibold mb-4">Daftar Buku</h2>
        <div id="bookGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
    </div>

    <script>
        const token = localStorage.getItem("token");

        function loadBooks() {
            const grid = document.getElementById("bookGrid");
            grid.innerHTML = "<p class='col-span-full'>Loading...</p>";

            fetch("/api/books", {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(data => {
                    grid.innerHTML = "";
                    data.forEach(book => {
                        const card = document.createElement("div");
                        card.className = "bg-white shadow rounded p-4 flex flex-col";
                        card.innerHTML = `
                <img src="${book.cover_photo ?? '/assets/images/default-book.jpg'}" alt="${book.title}" class="w-full h-48 object-cover rounded mb-2">
                <h3 class="text-md font-bold">${book.title}</h3>
                <p class="text-sm text-gray-500">Rp${Number(book.price).toLocaleString("id-ID")}</p>
                <p class="text-xs text-gray-500 mb-2">Stok: ${book.stock}</p>
                <button onclick="editBook(${book.id})" class="bg-yellow-500 text-white px-2 py-1 text-xs rounded mb-1">Edit</button>
                <button onclick="deleteBook(${book.id})" class="bg-red-500 text-white px-2 py-1 text-xs rounded">Hapus</button>
            `;
                        grid.appendChild(card);
                    });
                })
                .catch(err => {
                    console.error(err);
                    grid.innerHTML = "<p class='col-span-full text-red-500'>Gagal memuat data.</p>";
                });
        }

        document.getElementById("bookForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const id = document.getElementById("bookId").value;
            const payload = {
                title: document.getElementById("title").value,
                price: document.getElementById("price").value,
                stock: document.getElementById("stock").value,
                cover_photo: document.getElementById("cover_photo").value,
                genre_id: document.getElementById("genre_id").value,
                author_id: document.getElementById("author_id").value,
                description: document.getElementById("description").value,
            };

            let url = "/api/books";
            let method = "POST";
            if (id) {
                url += `/${id}`;
                method = "PUT";
            }

            fetch(url, {
                    method: method,
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(() => {
                    alert(id ? "Buku berhasil diupdate!" : "Buku berhasil ditambah!");
                    document.getElementById("bookForm").reset();
                    document.getElementById("bookId").value = "";
                    document.getElementById("submitBtn").textContent = "Tambah Buku";
                    loadBooks();
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi kesalahan!");
                });
        });

        window.editBook = function(id) {
            fetch(`/api/books/${id}`, {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(book => {
                    document.getElementById("bookId").value = book.id;
                    document.getElementById("title").value = book.title;
                    document.getElementById("price").value = book.price;
                    document.getElementById("stock").value = book.stock;
                    document.getElementById("cover_photo").value = book.cover_photo;
                    document.getElementById("genre_id").value = book.genre_id;
                    document.getElementById("author_id").value = book.author_id;
                    document.getElementById("description").value = book.description;
                    document.getElementById("submitBtn").textContent = "Update Buku";
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                });
        };

        window.deleteBook = function(id) {
            if (!confirm("Yakin ingin menghapus buku ini?")) return;

            fetch(`/api/books/${id}`, {
                    method: "DELETE",
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(() => {
                    alert("Buku berhasil dihapus!");
                    loadBooks();
                })
                .catch(err => {
                    console.error(err);
                    alert("Gagal menghapus buku!");
                });
        };

        loadBooks();
    </script>
</body>

</html>
