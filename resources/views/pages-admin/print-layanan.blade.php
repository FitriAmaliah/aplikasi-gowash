@extends('layouts.layout-admin')

@section('title', 'Print Layanan-Admin')

@section('content')
<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Cetak Struk Pembelian</h5>
            </div>

            <!-- Struk Pembelian -->
            <div id="receipt" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm mx-auto mb-6">
                <div class="text-center font-bold text-lg mb-2">Struk Layanan Cuci Kendaraan</div>
                <div class="text-center text-gray-700">Tanggal: {{ now()->format('d M Y') }}</div>
                <div class="text-center text-gray-700">
                    <span id="realTimeClock">
                        Waktu: {{ now()->format('H:i:s') }}
                    </span>
                </div>            
                <div class="text-center text-gray-700">GoWash</div>
        
                <!-- Informasi Transaksi -->
                <div class="mb-4 space-y-1">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nama Pelanggan:</span>
                        <span class="font-semibold">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">ID Member:</span>
                        <span class="font-semibold">{{ $order->user->id_member  ?? 'Tidak Ada' }}</span>
                    </div>
                    <div class="flex justify-between">
                            <span class="text-gray-600">Jenis Kendaraan:</span>
                            <span class="font-semibold">{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</span>
                        </div>
                    <div class="flex justify-between">
                            <span class="text-gray-600">Plat Nomor:</span>
                            <span class="font-semibold">{{ $order->plat_nomor ?? 'Tidak Ada'}}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran:</span>
                            <span class="font-semibold">{{ $order->metode_pembayaran }}</span>
                        </div>
                    <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-semibold">{{ $order->status_pembayaran }}</span>
                        </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Biaya:</span>
                        <span class="font-semibold">Rp {{ number_format($order->biaya, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Layanan -->
                <div class="mb-4 space-y-1">
                    <div class="flex justify-between font-semibold">
                        <span>Layanan</span>
                        <span>Harga</span>
                    </div>
                    <!-- Tampilkan hanya satu layanan untuk contoh -->
                    <div class="flex justify-between">
                        <span>{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</span>
                        <span>Rp {{ number_format($order->biaya, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Total Pembayaran -->
                <div class="border-t pt-2">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->biaya, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-center text-sm text-gray-600 mt-4">Terima Kasih atas Kunjungan Anda!</div>
                </div>
            </div>
        
            <!-- Tombol Cetak -->
            <div class="text-center">
                <a href="{{ route('print-receipt', ['id' => $order->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    <i class="fa-solid fa-print"></i>
                    Cetak Struk
                </a>
            </div>
        </div>
    </div>
</div>

 <!-- Script untuk Update Waktu -->
 <script>
    // Fungsi untuk memperbarui waktu
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;

        // Menampilkan waktu di elemen dengan id 'realTimeClock'
        document.getElementById('realTimeClock').textContent = 'Waktu: ' + timeString;
    }

    // Memperbarui waktu setiap detik
    setInterval(updateClock, 1000);

    // Menampilkan waktu saat pertama kali halaman dimuat
    updateClock();
</script>

@endsection
