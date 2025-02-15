@extends('layouts.layout-admin')

@section('title', 'Ulasan Pengguna-Admin')

@section('content')

<!-- Content Area -->
<div class="bg-indigo-100 py-8">
    <div class="container mx-auto p-4">
        <h2 class="text-center text-2xl font-extrabold text-indigo-600 mb-6">Ulasan Pengguna</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($ulasan as $item)
                <div class="bg-white shadow-xl rounded-2xl p-4 hover:shadow-2xl hover:scale-105 transition duration-300 ease-in-out transform hover:bg-indigo-50">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <img 
                                src="{{ $item->profile_picture ? asset('storage/' . $item->profile_picture) : asset('/assets/profile.png') }}" 
                                alt="Foto Profil {{ $item->nama_pengguna }}" 
                                class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <h3 class="font-semibold text-xl text-gray-800">{{ $item->nama_pengguna }}</h3>
                                <span class="text-gray-500 text-sm">Tanggal: {{ $item->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                        <!-- Tombol Hapus di sebelah kanan -->
                        <form action="{{ route('ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                    <div class="flex mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-lg {{ $i <= $item->rating ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
                        @endfor
                    </div>
                    <p class="text-gray-700 text-md">{{ $item->komentar }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-2">Belum ada ulasan.</p>
            @endforelse
        </div>   
    </div>     
            <div class="pagination">
                {{ $ulasan->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

@endsection