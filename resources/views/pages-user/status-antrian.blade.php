@extends('layouts.layout-user')

@section('title', 'Status Antrian')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container mx-auto p-6">

    <!-- Status Antrian -->
    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-6 rounded-lg shadow-lg text-center mb-6">
        <h2 class="text-3xl font-semibold text-white mb-4">Status Antrian Anda</h2>
        <div class="text-2xl font-bold text-white mb-2">
            No Antrian: <span class="text-yellow-300">{{ $antrian['no_antrian'] }}</span>
        </div>
        <p class="text-xl text-white mb-2">Estimasi Waktu: <span class="font-semibold text-yellow-200">{{ $antrian['estimasi_waktu'] }} Menit</span></p>
        <div id="countdown" class="text-lg font-medium text-white mt-2">
            Waktu berjalan: {{ gmdate("i:s", $antrian['estimasi_waktu'] * 60) }}
        </div>
    </div>

    <!-- Informasi Pemesanan -->
    <div class="bg-white p-6 rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Detail Pemesanan</h2>

        <!-- Search Input -->
        <div class="flex justify-between items-center p-4">
            <div class="flex justify-center mb-4">
                <div class="relative w-full max-w-xs">
                    <form action="{{ route('status.antrian') }}" method="GET">
                        <input 
                            id="search-input" 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}" 
                            placeholder="Cari nama layanan..." 
                            class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                        />
                        <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p> <!-- Pesan tidak ditemukan -->                    
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </span>
                    </form>
                </div>
            </div>  
        </div>

        <div class="overflow-x-auto scrollbar-hide">
            <div class="min-w-full w-64">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                    <thead class="bg-indigo-500 text-white">
                        <tr class="bg-indigo-500">
                            <th class="px-4 py-2 text-center text-sm font-medium text-white">No Antrian</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-white">Tanggal Pemesanan</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-white">Status</th>
                            <th class="px-4 py-2 text-center ext-sm font-medium text-white">Layanan</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-white">Estimasi Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr class="hover:bg-indigo-500 transition-all duration-200">
                            <td class="border px-4 py-2 text-center text-sm text-gray-600">{{ $pemesanan['no_antrian'] }}</td>
                            <td class="border px-4 py-2 text-center text-sm text-gray-600">{{ $pemesanan['tanggal'] }}</td>
                            <td class="border px-4 py-2 text-center text-sm">
                                <span class="text-yellow-600 font-semibold">{{ $pemesanan['status'] }}</span>
                            </td>
                            <!-- Layanan Column -->
                            <td class="border px-4 py-2 text-center text-sm">
                                @foreach ($layanan as $item)
                                    <p class="text-gray-700">{{ $item['nama'] }}</p>
                                @endforeach
                            </td>
                            <!-- Estimasi Waktu Column -->
                            <td class="border px-4 py-2 text-center text-sm">
                                @foreach ($layanan as $item)
                                    <p class="text-gray-700">{{ $item['estimasi'] }} Menit</p>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    let totalTime = {{ $antrian['estimasi_waktu'] }} * 60;
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

    function filterTable() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            const noAntrian = row.cells[0].textContent.toLowerCase();
            if (noAntrian.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

@endsection
