@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">🚚 Checkout & Delivery</h2>

        <form id="checkoutForm">
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Alamat Pengiriman</label>
                <textarea name="delivery_address" id="delivery_address" rows="3"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-blue-200" required></textarea>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
                Konfirmasi Checkout
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Function apiPost dengan JWT token
        async function apiPost(url, data) {
            const token = localStorage.getItem("token");
            const res = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer " + token
                },
                body: JSON.stringify(data)
            });
            if (!res.ok) {
                const errorData = await res.json();
                throw new Error(errorData.message || `HTTP error! status: ${res.status}`);
            }
            return await res.json();
        }

        // Function showAlert sederhana
        function showAlert(message, type = "success") {
            const bgColor = type === "success" ? "#16a34a" : "#dc2626";
            const alert = document.createElement("div");
            alert.textContent = message;
            alert.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 14px 20px;
                background-color: ${bgColor};
                color: white;
                border-radius: 6px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.2);
                z-index: 9999;
            `;
            document.body.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }

        document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const address = document.getElementById('delivery_address').value;

            try {
                const res = await apiPost('/api/payments', {
                    delivery_address: address,
                    // Kalau pakai cart otomatis, total_amount dihitung di backend
                    status: 'pending' // default value (optional)
                });

                showAlert('Checkout berhasil!', 'success');
                // Redirect ke halaman sukses atau home
                window.location.href = '/';
            } catch (err) {
                console.error(err);
                showAlert('Gagal melakukan checkout: ' + err.message, 'error');
            }
        });
    </script>
@endpush
