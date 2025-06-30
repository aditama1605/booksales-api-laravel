@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <form id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" required class="w-full border px-3 py-2 rounded"
                        placeholder="Alamat Email" autocomplete="email" aria-label="Email" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" required class="w-full border px-3 py-2 rounded"
                        placeholder="Kata Sandi" autocomplete="current-password" aria-label="Password" />
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
            </form>
            <p class="mt-4 text-sm text-center">
                Belum punya akun? <a href="{{ url('/register') }}" class="text-blue-600">Daftar di sini</a>
            </p>
        </div>
    </div>

    <script>
        function showAlert(message, type = 'success') {
            const bgColor = type === 'error' ? 'bg-red-500' : 'bg-green-500';
            const alertBox = document.createElement('div');
            alertBox.className =
                `${bgColor} text-white px-4 py-2 rounded mb-4 text-center fixed top-5 left-1/2 transform -translate-x-1/2 z-50 shadow-lg`;
            alertBox.innerText = message;
            document.body.appendChild(alertBox);
            setTimeout(() => alertBox.remove(), 3000);
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = new FormData(this);
            const payload = {
                email: form.get('email'),
                password: form.get('password'),
            };

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (response.ok && result.access_token) {
                    localStorage.setItem('token', result.access_token);
                    showAlert('Login sukses!');

                    // 🔄 Redirect berdasarkan role
                    if (result.user && result.user.role === 'admin') {
                        window.location.href = '/admin/dashboard';
                    } else {
                        window.location.href = '/';
                    }
                } else {
                    showAlert(result.message || 'Login gagal', 'error');
                }
            } catch (err) {
                showAlert('Terjadi kesalahan jaringan', 'error');
            }
        });
    </script>
@endsection
