@extends('layouts.siswa')

@section('header_title', 'Rekap Nilai')

@section('content')
    <div class="bg-white/90 card-shadow p-6 rounded-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Nilai Tugas</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Judul Tugas</th>
                        <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                        <th class="py-3 px-6 text-center">Nilai</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($jawaban as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium text-gray-800">
                                {{ $item->tugas->judul }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $item->tugas->mataPelajaran->nama_mapel }}
                            </td>
                            <td class="py-3 px-6 text-center font-bold text-lg">
                                @if ($item->nilai)
                                    <span class="{{ $item->nilai >= 75 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->nilai }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('siswa.tugas.show', $item->tugas) }}"
                                    class="bg-indigo-500 text-white py-1 px-3 rounded-full text-xs hover:bg-indigo-600 transition">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">Anda belum mengumpulkan tugas
                                apapun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $jawaban->links() }}
        </div>
    </div>
@endsection
