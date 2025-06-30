<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - Kategori Buku</title>
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
                <li><a href="/admin/dashboard"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Dashboard</a></li>
                <li><a href="/admin/books" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Buku</a></li>
                <li><a href="/admin/categories"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Kategori</a></li>
                <li><a href="/admin/users" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pengguna</a>
                </li>
                <li><a href="/admin/orders" class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Pesanan</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Konten utama -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6"> Kategori Buku</h1>

        <!-- Form -->
        <form id="categoryForm" class="bg-white p-6 rounded shadow mb-8 flex gap-4 flex-wrap">
            <input type="hidden" id="categoryId">
            <input type="text" id="name" placeholder="Nama Kategori" class="border p-2 rounded flex-grow"
                required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" id="submitBtn">Tambah
                Kategori</button>
        </form>

        <h2 class="text-xl font-semibold mb-4">Daftar Kategori</h2>
        <div id="categoryList" class="space-y-4"></div>
    </main>

    <script>
        const token = localStorage.getItem("token");

        function loadCategories() {
            const list = document.getElementById("categoryList");
            list.innerHTML = "<p>Loading...</p>";

            fetch("/api/categories", {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(data => {
                    list.innerHTML = "";
                    data.forEach(category => {
                        const div = document.createElement("div");
                        div.className = "bg-white shadow p-4 rounded flex justify-between items-center";
                        div.innerHTML = `
                        <span class="font-medium">${category.name}</span>
                        <div class="flex gap-2">
                            <button onclick="editCategory(${category.id})" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</button>
                            <button onclick="deleteCategory(${category.id})" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                        </div>
                    `;
                        list.appendChild(div);
                    });
                })
                .catch(err => {
                    console.error(err);
                    list.innerHTML = "<p class='text-red-500'>Gagal memuat kategori.</p>";
                });
        }

        document.getElementById("categoryForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const id = document.getElementById("categoryId").value;
            const payload = {
                name: document.getElementById("name").value
            };

            let url = "/api/categories";
            let method = "POST";
            if (id) {
                url += `/${id}`;
                method = "PUT";
            }

            fetch(url, {
                    method: method,
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + token
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(() => {
                    alert(id ? "Kategori berhasil diupdate!" : "Kategori berhasil ditambah!");
                    document.getElementById("categoryForm").reset();
                    document.getElementById("categoryId").value = "";
                    document.getElementById("submitBtn").textContent = "Tambah Kategori";
                    loadCategories();
                })
                .catch(err => {
                    console.error(err);
                    alert("Gagal menyimpan kategori!");
                });
        });

        window.editCategory = function(id) {
            fetch(`/api/categories/${id}`, {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(category => {
                    document.getElementById("categoryId").value = category.id;
                    document.getElementById("name").value = category.name;
                    document.getElementById("submitBtn").textContent = "Update Kategori";
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                });
        };

        window.deleteCategory = function(id) {
            if (!confirm("Yakin ingin menghapus kategori ini?")) return;

            fetch(`/api/categories/${id}`, {
                    method: "DELETE",
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(() => {
                    alert("Kategori berhasil dihapus!");
                    loadCategories();
                })
                .catch(err => {
                    console.error(err);
                    alert("Gagal menghapus kategori!");
                });
        };

        loadCategories();
    </script>
</body>

</html>
