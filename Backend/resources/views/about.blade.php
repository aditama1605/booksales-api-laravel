@extends('layouts.app')

@section('content')
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Judul -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-extrabold text-gray-800 mb-4">Tentang Kami</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    BookStore adalah tempat di mana dunia pengetahuan dan imajinasi bertemu. Kami hadir untuk para pembaca,
                    pelajar, dan pencinta literasi.
                </p>
            </div>

            <!-- Konten Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Gambar -->
                <div>
                    <img src="{{ asset('images/foto.jpeg') }}" alt="Tentang BookStore" class="w-full rounded-xl shadow-lg">
                </div>

                <!-- Deskripsi -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Kami Lebih dari Sekadar Toko Buku</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Sejak awal berdirinya, BookStore memiliki misi untuk menghadirkan literatur berkualitas ke tangan
                        pembaca dari seluruh penjuru negeri.
                        Kami percaya bahwa setiap buku memiliki kekuatan untuk mengubah cara pandang, memperluas wawasan,
                        dan membangun masa depan yang lebih baik.
                    </p>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Dengan koleksi ribuan judul buku dari berbagai genre, layanan pelanggan yang responsif, dan sistem
                        pembayaran yang aman — kami menjadi mitra tepercaya bagi ribuan pelanggan.
                    </p>
                    <a href="{{ url('/books') }}"
                        class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition duration-200">
                        Telusuri Koleksi Kami
                    </a>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="mt-20 bg-gray-50 p-10 rounded-2xl shadow-inner">
                <div class="grid md:grid-cols-2 gap-10">
                    <div>
                        <h3 class="text-xl font-semibold text-blue-700 mb-2">🎯 Visi Kami</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Menjadi toko buku online terbaik di Indonesia yang mendukung peningkatan literasi nasional dan
                            memperkuat budaya membaca di era digital.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-blue-700 mb-2">🚀 Misi Kami</h3>
                        <ul class="list-disc pl-5 text-gray-700 space-y-2">
                            <li>Menyediakan buku berkualitas dari penerbit terpercaya.</li>
                            <li>Meningkatkan akses buku ke seluruh daerah di Indonesia.</li>
                            <li>Memberikan pengalaman belanja yang cepat, aman, dan nyaman.</li>
                            <li>Berperan aktif dalam gerakan literasi digital dan pendidikan.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tim Kami (Opsional) -->
            <div class="mt-20 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-8">Tim di Balik BookStore</h3>
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach ([['name' => 'Adi indra', 'role' => 'Founder & CEO'], ['name' => 'indra tama', 'role' => 'CTO'], ['name' => 'tama', 'role' => 'Marketing Lead'], ['name' => 'indra', 'role' => 'Customer Success']] as $member)
                        <div class="bg-white p-6 rounded-lg shadow text-center">
                            <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-4"></div>
                            <h4 class="text-lg font-semibold text-gray-700">{{ $member['name'] }}</h4>
                            <p class="text-sm text-gray-500">{{ $member['role'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
