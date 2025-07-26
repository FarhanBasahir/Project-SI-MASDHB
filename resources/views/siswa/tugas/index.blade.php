@extends('layouts.siswa')

@section('header_title', 'Daftar Tugas')

@section('content')
    <div class="bg-white/90 card-shadow p-6 rounded-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tugas Pelajaran</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Judul Tugas</th>
                        <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                        <th class="py-3 px-6 text-left">Deadline</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($tugas as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium text-gray-800">
                                {{ $item->judul }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $item->mataPelajaran->nama_mapel }}
                            </td>
                            <td
                                class="py-3 px-6 text-left {{ now()->gt($item->tanggal_deadline) ? 'text-red-500 font-semibold' : '' }}">
                                {{ \Carbon\Carbon::parse($item->tanggal_deadline)->isoFormat('dddd, D MMMM YYYY, HH:mm') }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('siswa.tugas.show', $item) }}"
                                    class="bg-indigo-500 text-white py-1 px-3 rounded-full text-xs hover:bg-indigo-600 transition">
                                    Lihat & Kerjakan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">Tidak ada tugas saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $tugas->links() }}
        </div>
    </div>
@endsection
