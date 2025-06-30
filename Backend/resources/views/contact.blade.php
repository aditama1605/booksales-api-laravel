@extends('layouts.app')

@section('content')
    <section class="bg-white py-20">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-800">Hubungi Kami</h1>
                <p class="text-lg text-gray-600 mt-4">Kami siap membantu Anda dengan pertanyaan, saran, atau kendala apa pun
                    terkait layanan kami.</p>
            </div>

            <!-- Konten -->
            <div class="bg-gray-50 p-10 rounded-xl shadow-xl">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informasi Kontak</h2>

                <div class="space-y-4 text-gray-700">
                    <p><strong>📍 Alamat:</strong> Jl. Buku No. 42, Literasi City, Indonesia</p>
                    <p><strong>📧 Email:</strong> support@bookstore.com</p>
                    <p><strong>📞 WhatsApp Admin:</strong> <a href="https://wa.me/6288231702740" target="_blank"
                            class="text-green-600 hover:underline">+62 882-3170-2740</a></p>
                </div>

                <div class="mt-8">
                    <a href="https://wa.me/6288231702740" target="_blank"
                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 32 32">
                            <path
                                d="M16 0C7.163 0 0 7.162 0 16c0 2.82.735 5.464 2.03 7.775L0 32l8.48-2.212C10.87 31.27 13.356 32 16 32c8.837 0 16-7.163 16-16S24.837 0 16 0zm0 29.5c-2.406 0-4.709-.635-6.738-1.752l-.481-.274-5.034 1.314 1.342-4.902-.313-.504C3.53 21.073 3 18.584 3 16 3 8.82 8.82 3 16 3s13 5.82 13 13-5.82 13-13 13zm7.294-9.372c-.4-.2-2.366-1.169-2.733-1.302-.366-.133-.633-.2-.9.2-.266.4-1.033 1.302-1.266 1.568-.232.267-.466.3-.866.1-.4-.2-1.686-.621-3.21-1.981-1.185-1.059-1.986-2.366-2.219-2.766-.232-.4-.025-.6.175-.8.18-.18.4-.466.6-.7.2-.232.266-.4.4-.666.133-.266.066-.5-.033-.7-.1-.2-.9-2.166-1.232-2.966-.325-.783-.656-.68-.9-.692l-.767-.015c-.267 0-.7.1-1.066.5-.366.4-1.4 1.367-1.4 3.334 0 1.966 1.433 3.867 1.633 4.133.2.267 2.817 4.3 6.833 6.033 4.016 1.732 4.016 1.154 4.733 1.087.7-.066 2.366-.967 2.7-1.9.333-.933.333-1.733.233-1.9-.1-.167-.367-.267-.767-.467z" />
                        </svg>
                        Chat Admin via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
