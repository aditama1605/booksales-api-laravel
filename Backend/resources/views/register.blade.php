@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Registrasi</h2>
            <form id="registerForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="name" required class="w-full border px-3 py-2 rounded" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" required class="w-full border px-3 py-2 rounded" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" required class="w-full border px-3 py-2 rounded" />
                </div>
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Daftar</button>
            </form>
            <p class="mt-4 text-sm text-center">
                Sudah punya akun? <a href="{{ url('/login') }}" class="text-blue-600">Login</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = new FormData(this);

            const response = await fetch('/api/register', {
                method: 'POST',
                body: form
            });

            const result = await response.json();

            if (response.ok) {
                alert('Registrasi berhasil!');
                window.location.href = '/login';
            } else {
                alert(result.message || 'Registrasi gagal');
            }
        });
    </script>
@endsection
