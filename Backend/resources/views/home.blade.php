@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di BookStore</h1>
                <p class="mt-4 text-lg text-gray-600">Temukan buku favoritmu, baca ulasannya, dan belanja dengan mudah!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kategori Buku -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="{{ asset('images/rak buku.jpg') }}" alt="Kategori" class="mx-auto h-24 mb-4">
                    <h3 class="text-xl font-semibold">Kategori Buku</h3>
                    <p class="text-gray-500 mt-2">Jelajahi berdasarkan genre dan penulis</p>
                    <a href="{{ url('/books') }}"
                        class="mt-4 inline-block text-blue-600 font-semibold hover:underline">Lihat Buku</a>
                </div>

                <!-- Keranjang -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="{{ asset('images/trolli.jpg') }}" alt="Keranjang" class="mx-auto h-24 mb-4">
                    <h3 class="text-xl font-semibold">Keranjang</h3>
                    <p class="text-gray-500 mt-2">Lihat atau kelola pesananmu</p>
                    <a href="{{ url('/cart') }}"
                        class="mt-4 inline-block text-blue-600 font-semibold hover:underline">Lihat Keranjang</a>
                </div>

                <!-- Akun -->

            </div>
        </div>
    </div>
@endsection
