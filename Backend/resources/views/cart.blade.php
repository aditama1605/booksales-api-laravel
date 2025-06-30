@extends('layouts.app')

@section('content')
    <section class="bg-gray-100 py-10 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">🛒 Keranjang Belanja</h1>

            @if (session('success'))
                <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
            @endif

            @if (empty($items))
                <p>Keranjang kosong. <a href="/books" class="text-blue-600 underline">Lanjut belanja</a></p>
            @else
                <table class="w-full mb-6 bg-white shadow rounded overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Judul</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Subtotal</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $item['book']->title }}</td>
                                <td class="px-4 py-2">Rp{{ number_format($item['book']->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <form method="POST" action="{{ url('/cart/update/' . $item['book']->id) }}">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="w-16 border rounded px-2 py-1">
                                        <button type="submit" class="text-blue-600 ml-2">Update</button>
                                    </form>
                                </td>
                                <td class="px-4 py-2">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <form method="POST" action="{{ url('/cart/delete/' . $item['book']->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="text-right text-xl font-semibold">Total: Rp{{ number_format($total, 0, ',', '.') }}</p>
                <div class="text-right mt-4">
                    <a href="{{ url('/checkout') }}"
                        class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                        Checkout Sekarang
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
