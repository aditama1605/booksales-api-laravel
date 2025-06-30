<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - CRUD User (JWT)</title>
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
                <li><a href="/admin/users" class="block text-gray-700 bg-blue-100 px-3 py-2 rounded font-bold">Users</a>
                <li><a href="/admin/categories"
                        class="block text-gray-700 hover:bg-blue-50 px-3 py-2 rounded">Kategori</a></li>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 max-w-screen-xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">👤 Admin - User Management</h1>

        <!-- Form User -->
        <form id="userForm" class="bg-white p-6 rounded shadow mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="hidden" id="userId">
            <input type="text" id="name" placeholder="Nama" class="border p-2 rounded" required>
            <input type="email" id="email" placeholder="Email" class="border p-2 rounded" required>
            <input type="password" id="password" placeholder="Password (kosong = tidak ubah)"
                class="border p-2 rounded">
            <select id="role" class="border p-2 rounded" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded md:col-span-2" id="submitBtn">Tambah
                User</button>
        </form>

        <!-- List User -->
        <h2 class="text-xl font-semibold mb-4">Daftar User</h2>
        <div id="userGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
    </div>

    <script>
        const token = localStorage.getItem("token");

        function loadUsers() {
            const grid = document.getElementById("userGrid");
            grid.innerHTML = "<p class='col-span-full'>Loading...</p>";

            fetch("/api/users", {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(data => {
                    grid.innerHTML = "";
                    data.forEach(user => {
                        const card = document.createElement("div");
                        card.className = "bg-white shadow rounded p-4 flex flex-col";
                        card.innerHTML = `
                            <h3 class="text-md font-bold">${user.name}</h3>
                            <p class="text-sm text-gray-500">${user.email}</p>
                            <p class="text-xs text-gray-500 mb-2">Role: ${user.role}</p>
                            <button onclick="editUser(${user.id})" class="bg-yellow-500 text-white px-2 py-1 text-xs rounded mb-1">Edit</button>
                            <button onclick="deleteUser(${user.id})" class="bg-red-500 text-white px-2 py-1 text-xs rounded">Hapus</button>
                        `;
                        grid.appendChild(card);
                    });
                })
                .catch(err => {
                    console.error(err);
                    grid.innerHTML = "<p class='col-span-full text-red-500'>Gagal memuat data user.</p>";
                });
        }

        document.getElementById("userForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const id = document.getElementById("userId").value;
            const payload = {
                name: document.getElementById("name").value,
                email: document.getElementById("email").value,
                role: document.getElementById("role").value,
            };
            const password = document.getElementById("password").value;
            if (password) payload.password = password;

            let url = "/api/users";
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
                    alert(id ? "User berhasil diupdate!" : "User berhasil ditambah!");
                    document.getElementById("userForm").reset();
                    document.getElementById("userId").value = "";
                    document.getElementById("submitBtn").textContent = "Tambah User";
                    loadUsers();
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi kesalahan!");
                });
        });

        window.editUser = function(id) {
            fetch(`/api/users/${id}`, {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(user => {
                    document.getElementById("userId").value = user.id;
                    document.getElementById("name").value = user.name;
                    document.getElementById("email").value = user.email;
                    document.getElementById("role").value = user.role;
                    document.getElementById("submitBtn").textContent = "Update User";
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                });
        };

        window.deleteUser = function(id) {
            if (!confirm("Yakin ingin menghapus user ini?")) return;

            fetch(`/api/users/${id}`, {
                    method: "DELETE",
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(() => {
                    alert("User berhasil dihapus!");
                    loadUsers();
                })
                .catch(err => {
                    console.error(err);
                    alert("Gagal menghapus user!");
                });
        };

        loadUsers();
    </script>
</body>

</html>
