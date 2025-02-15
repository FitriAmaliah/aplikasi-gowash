@extends('layouts.layout-karyawan')

@section('title', 'Antrian')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@php
    // Contoh data statis
    $antrian = [
        ['no_antrian' => 'A001', 'nama' => 'Budi Santoso', 'estimasi_waktu' => '45 Menit', 'tanggal_pemesanan' => '2025-02-07', 'status_pemesanan' => 'Belum Diproses'],
        ['no_antrian' => 'A002', 'nama' => 'Siti Aminah', 'estimasi_waktu' => '30 Menit', 'tanggal_pemesanan' => '2025-02-07', 'status_pemesanan' => 'Proses'],
        ['no_antrian' => 'A003', 'nama' => 'Amelia Maharani', 'estimasi_waktu' => '60 Menit', 'tanggal_pemesanan' => '2025-02-07', 'status_pemesanan' => 'Belum Diproses'],
    ];

    // Ambil data antrian pertama untuk estimasi waktu utama
    $antrianUtama = $antrian[0];
@endphp

<div class="container mx-auto p-4">
    <!-- Estimasi Waktu -->
    <div class="bg-blue-100 p-4 rounded-lg shadow-md text-center mb-4">
        <h2 class="text-lg font-semibold">Estimasi Waktu Pengerjaan</h2>
        <p class="text-2xl font-bold text-blue-600" id="estimasiWaktu">{{ $antrianUtama['estimasi_waktu'] }}</p>
        <p class="text-lg font-semibold">Nomor Antrian: <span class="text-blue-600 font-bold">{{ $antrianUtama['no_antrian'] }}</span></p>
        <p class="text-lg font-semibold">Nama Pelanggan: <span class="text-blue-600 font-bold">{{ $antrianUtama['nama'] }}</span></p>
        <div id="countdown" class="text-xl font-medium text-blue-800">Waktu berjalan: 45:00</div>
    </div>

    <!-- Informasi Pemesanan -->
    <div class="bg-white p-6 rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Data Antrian</h2>

        <!-- Tabel Antrian -->
        <div class="overflow-x-auto scrollbar-hide">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No Antrian</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Estimasi Waktu</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Pemesanan</th>
                        <th class="border border-gray-300 px-4 py-2">Status Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrian as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['no_antrian'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['nama'] }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['estimasi_waktu'] }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['tanggal_pemesanan'] }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <span class="text-{{ $item['status_pemesanan'] == 'Proses' ? 'blue' : 'yellow' }}-600 font-semibold">
                                {{ $item['status_pemesanan'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Estimasi waktu dan countdown
    let totalTime = 45 * 60; // 45 menit dalam detik
    let countdownElement = document.getElementById('countdown');

    function updateTime() {
        if (totalTime > 0) {
            let minutes = Math.floor(totalTime / 60);
            let seconds = totalTime % 60;
            countdownElement.textContent = `Waktu berjalan: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
            totalTime--;
        }
    }

    setInterval(updateTime, 1000);
</script>

@endsection
