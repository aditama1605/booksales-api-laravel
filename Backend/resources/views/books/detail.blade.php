@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 py-10">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                <!-- Gambar Buku -->
                <div class="overflow-hidden rounded-lg shadow-md bg-white">
                    <img src="{{ $book->cover_url ?? asset('assets/images/default-book.jpg') }}" alt="{{ $book->title }}"
                        class="w-full h-[450px] object-cover object-center transition-transform duration-300 hover:scale-105">
                </div>

                <!-- Detail Buku -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-gray-600 mb-1">Ditulis oleh
                        <strong>{{ $book->author->name ?? 'Tidak diketahui' }}</strong></p>
                    <p class="text-sm text-gray-500 mb-4">
                        Genre: <span class="italic">{{ $book->genre->name ?? 'Tidak ada genre' }}</span>
                    </p>
                    <p class="text-lg text-blue-600 font-bold mb-6">Rp{{ number_format($book->price, 0, ',', '.') }}</p>

                    <p class="text-gray-700 leading-relaxed mb-6">
                        {{ $book->description ?? 'Deskripsi belum tersedia untuk buku ini.' }}
                    </p>

                    <!-- Tambah ke Keranjang -->
                    <form action="{{ url('/cart/add/' . $book->id) }}" method="POST" class="flex items-center gap-4">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1"
                            class="w-20 border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 text-sm"
                            required>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition text-sm">
                            + Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-10 text-center">
                <a href="{{ url('/books') }}" class="inline-block text-blue-600 hover:underline text-sm">&larr; Kembali ke
                    Daftar Buku</a>
            </div>
        </div>
    </section>
@endsection
