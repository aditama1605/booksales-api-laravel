@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📚 Daftar Buku</h1>

        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row md:justify-between mb-6 gap-4">
            <form method="GET" action="{{ url('/books') }}" class="flex gap-2 w-full md:w-1/2">
                <input type="text" name="q" placeholder="Cari judul buku..."
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-200"
                    value="{{ request('q') }}">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Cari</button>
            </form>
        </div>

        <!-- Book List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <div class="bg-white shadow rounded overflow-hidden hover:shadow-md transition">
                    <img src="{{ $book->cover_url ?? asset('images/kancil-buaya.jpg') }}" alt="{{ $book->title }}"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold truncate">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">By: {{ $book->author->name ?? 'Tidak Diketahui' }}</p>
                        <p class="text-blue-600 font-bold text-md mb-2">Rp{{ number_format($book->price, 0, ',', '.') }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ url('/books/' . $book->id) }}"
                                class="text-sm text-white bg-blue-500 px-3 py-1 rounded hover:bg-blue-600">Detail</a>
                            <form method="POST" action="{{ url('/cart/add/' . $book->id) }}">
                                @csrf
                                <button type="submit"
                                    class="text-sm text-white bg-green-500 px-3 py-1 rounded hover:bg-green-600">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    Tidak ada buku ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
@endsection
