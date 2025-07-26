@extends('layouts.siswa')

@section('header_title', 'Materi Pelajaran')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Materi Pelajaran</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Judul Materi</th>
                        <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                        <th class="py-3 px-6 text-left">Guru</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($materis as $materi)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ $materi->judul }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $materi->mataPelajaran->nama_mapel }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $materi->user->name }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    @if ($materi->file_path)
                                        <a href="{{ Illuminate\Support\Facades\Storage::url($materi->file_path) }}"
                                            target="_blank" class="text-indigo-600 hover:text-indigo-900 mr-4">Unduh</a>
                                    @endif
                                    @if ($materi->link_url)
                                        <a href="{{ $materi->link_url }}" target="_blank"
                                            class="text-green-600 hover:text-green-900">Lihat Link</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center">Belum ada materi yang diunggah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $materis->links() }}
        </div>
    </div>
@endsection
