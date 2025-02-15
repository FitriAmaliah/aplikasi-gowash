@extends('layouts.layout-user')

@section('title', 'Status Pemesanan-User')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Status Pemesanan</h5>
            </div>

               <!-- Search Input -->
               <div class="flex items-center w-full sm:w-auto">
                <form action="{{ route('pages-user.status-pemesanan') }}" method="GET" class="relative w-full max-w-xs">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}" 
                        placeholder="Cari jenis layanan..." 
                        class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                    />
                    <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </span>
                </form>
            </div>     

            <!-- Table -->
            <div class="overflow-x-auto scrollbar-hide">
                <div class="min-w-full w-64  mt-4">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                        <thead class="bg-indigo-500 text-white">
                            <tr>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">No</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Nomor Antrian</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">ID Member</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Jenis Layanan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Jenis Kendaraan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Plat Nomor</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Tanggal Pesan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Metode Pembayaran</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Status Pemesanan</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Status Pengerjaan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @forelse($orders->where('status', '!=', 'Selesai') as $index => $order)
                                <tr id="order-{{ $order->id }}" class="border-t">
                                    <td class="text-center py-4 px-4">{{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->nomor_antrian ?? 'Tidak Ada'}}</td>
                                    <td class="py-3 px-4 text-center">{{ $order->user->id_member  ?? 'Tidak Ada' }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->layanan->nama_layanan }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</td>
                                    <td class="text-center py-4 px-4">{{ $order->plat_nomor ?? 'Tidak Ada'}}</td>
                                    <td class="text-center py-4 px-4">{{ $order->tanggal }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->metode_pembayaran }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->status_pembayaran }}</td>
                                    <td class="text-center py-3 px-3">
                                        <span class="status-label {{ $order->status === 'Selesai' ? 'bg-green-500' : 'bg-yellow-500' }} 
                                            text-white font-medium px-1 py-0.5 text-xs rounded-full shadow-md inline-block">
                                            {{ $order->status }}
                                        </span>                                                                                            
                                    </td>
                                    <td class="text-center py-4 px-4">
                                        <button 
                                            onclick="openModal({{ $order->id }})" 
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                                            <i class="fa-solid fa-eye mr-1"></i>Detail
                                                </button>
                                            </div>
                                        </td>                                    
                                    </tr>
                                    @empty
                                    <tr>
                                    <td colspan="8" class="text-center py-4 px-4 text-gray-500">Tidak ada data pemesanan.</td>
                                        <td colspan="10" class="items-center justify-center mx-auto text-center py-4 px-4 text-gray-500">Tidak ada data pemesanan.</td>
                                </tr>
                            @endforelse
                            </tbody>              
                        </table>
                    </div>
                </div>              
                <!-- Link Pagination -->
                <div class="mt-4">
                    {{ $orders->appends(['search' => request('search')])->links('pagination::tailwind') }}
                </div>

                <!-- Modal untuk Detail Pesanan -->
                @foreach ($orders as $order)
                <div id="detail-modal-{{ $order->id }}" class="detail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg md:w-1/3">
                        <h3 class="text-lg font-semibold mb-4">Detail Pesanan</h3>
                        <p><strong>Nomor Antrian:</strong>{{ $order->nomor_antrian  ?? 'Tidak Ada' }}</p>
                        <p><strong>ID Member:</strong>{{ $order->user->id_member  ?? 'Tidak Ada' }}</p>
                        <p><strong>Jenis Layanan:</strong> {{ $order->layanan->nama_layanan }}</p>
                        <p><strong>Jenis Kendaraan:</strong>{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</p>
                        <p><strong>Plat Nomor:</strong> {{ $order->plat_nomor ?? 'Tidak Ada'}}</p>
                        <p><strong>Tanggal Pesan:</strong> {{ $order->tanggal }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
                        <p><strong>Status Pemesanan:</strong>{{ $order->status_pembayaran }}</p>
                        <p><strong>Status Pengerjaan:</strong>{{ $order->status }}</p>
                        <button 
                            onclick="closeModal({{ $order->id }})" 
                            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            @endforeach

<!-- Scripts -->
<script>
   // Script untuk Modal
function openModal(id) {
    const modal = document.getElementById(`detail-modal-${id}`);
    if (modal) {
        modal.classList.remove('hidden');
        localStorage.setItem('activeModal', id); // Simpan ID modal yang dibuka
    }
}

function closeModal(id) {
    const modal = document.getElementById(`detail-modal-${id}`);
    if (modal) {
        modal.classList.add('hidden');
        localStorage.removeItem('activeModal'); // Hapus ID modal yang tersimpan
    }
}

// Periksa modal yang tersimpan saat halaman dimuat
window.addEventListener('DOMContentLoaded', () => {
    const activeModalId = localStorage.getItem('activeModal');
    if (activeModalId) {
        const modal = document.getElementById(`detail-modal-${activeModalId}`);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }
});

</script>

<style>
    /* Utility Class to Hide Scrollbar */
.scrollbar-hide::-webkit-scrollbar {
display: none;
}

.scrollbar-hide {
-ms-overflow-style: none; /* IE and Edge */
scrollbar-width: none; /* Firefox */
}
</style>

<style>
    /* Utility Class to Hide Scrollbar */
.scrollbar-hide::-webkit-scrollbar {
display: none;
}

.scrollbar-hide {
-ms-overflow-style: none; /* IE and Edge */
scrollbar-width: none; /* Firefox */
}
</style>

@endsection