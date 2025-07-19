<?php

namespace App\Http\Controllers; // Pastikan namespace ini benar

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use Carbon\Carbon;


class PendaftaranController extends Controller // Pastikan nama kelas ini benar
{
  /**
   * Menampilkan formulir pendaftaran.
   */
  public function create()
  {
    $tanggalBuka = Setting::where('key', 'tanggal_buka')->first()->value ?? null;
    $tanggalTutup = Setting::where('key', 'tanggal_tutup')->first()->value ?? null;
    $sekarang = Carbon::now();

    // Cek jika tanggal pendaftaran sudah diatur
    if ($tanggalBuka && $tanggalTutup) {
      $tglBuka = Carbon::parse($tanggalBuka);
      $tglTutup = Carbon::parse($tanggalTutup)->endOfDay(); // Sampai akhir hari

      // Cek apakah pendaftaran sedang ditutup
      if (!$sekarang->between($tglBuka, $tglTutup)) {
        // Anda bisa membuat view khusus untuk halaman pendaftaran ditutup
        return view('pendaftaran_ditutup', [
          'tanggal_buka' => $tglBuka->isoFormat('D MMMM Y'),
          'tanggal_tutup' => $tglTutup->isoFormat('D MMMM Y')
        ]);
      }
    }

    // Jika pendaftaran dibuka, tampilkan form
    return view('pendaftaran');
  }

  /**
   * Menyimpan data pendaftar baru.
   */
  public function store(Request $request)
  {
    // Langkah 1: Validasi semua input dari form, termasuk file.
    // Ini akan mengembalikan array berisi data yang valid.
    $validatedData = $request->validate([
      'nama_lengkap' => 'required|string|max:255',
      'nisn' => 'required|string|unique:pendaftars,nisn|max:10',
      'tempat_lahir' => 'required|string',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string',
      'agama' => 'required|string',
      'asal_sekolah' => 'required|string',
      'alamat' => 'required|string',
      'nama_ayah' => 'required|string',
      'pekerjaan_ayah' => 'required|string',
      'nama_ibu' => 'required|string',
      'pekerjaan_ibu' => 'required|string',
      'nomor_hp_ortu' => 'required|string',
      'dokumen_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
      'dokumen_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
      'dokumen_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Langkah 2: Proses upload file secara eksplisit.
    // Simpan file ke storage dan ganti isinya di array $validatedData dengan path-nya.
    if ($request->hasFile('dokumen_ijazah')) {
      $validatedData['dokumen_ijazah'] = $request->file('dokumen_ijazah')->store('dokumen-ijazah', 'public');
    }
    if ($request->hasFile('dokumen_foto')) {
      $validatedData['dokumen_foto'] = $request->file('dokumen_foto')->store('dokumen-foto', 'public');
    }
    if ($request->hasFile('dokumen_kk')) {
      $validatedData['dokumen_kk'] = $request->file('dokumen_kk')->store('dokumen-kk', 'public');
    }

    // Langkah 3: Generate nomor pendaftaran.
    $tahun = date('Y');
    $latestSiswa = Pendaftar::whereYear('created_at', $tahun)->latest('id')->first();
    $nomorUrut = $latestSiswa ? (int)substr($latestSiswa->nomor_pendaftaran, -4) + 1 : 1;

    // Langkah 4: Tambahkan data yang tidak ada di form ke dalam array.
    $validatedData['nomor_pendaftaran'] = "PPDB-{$tahun}-" . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
    $validatedData['status_pendaftaran'] = 'Menunggu Verifikasi';

    // Langkah 5: Simpan semua data ke database.
    // Array $validatedData sekarang sudah berisi semua data teks dan path file.
    $pendaftar = Pendaftar::create($validatedData);

    // Langkah 6: Redirect ke halaman sukses.
    return redirect()->route('pendaftaran.sukses', ['id' => $pendaftar->id]);
  }

  /**
   * Menampilkan halaman pendaftaran sukses.
   */
  public function sukses($id)
  {
    // Ganti Pendaftar dengan model Anda jika namanya berbeda
    $siswa = Pendaftar::findOrFail($id);
    // Jangan lupa buat view 'pendaftaran_sukses.blade.php'
    return view('pendaftaran_sukses', compact('siswa'));
  }

  public function showCheckStatusForm()
  {
    return view('cek_status');
  }

  /**
   * Memproses pengecekan status berdasarkan nomor pendaftaran.
   */
  public function checkStatus(Request $request)
  {
    $request->validate([
      'nomor_pendaftaran' => 'required|string',
    ]);

    $nomorPendaftaran = $request->input('nomor_pendaftaran');
    $siswa = Pendaftar::where('nomor_pendaftaran', $nomorPendaftaran)->first();

    // Kembali ke view cek_status dengan membawa data siswa jika ditemukan
    return view('cek_status', [
      'siswa' => $siswa,
      'nomor_pendaftaran_input' => $nomorPendaftaran // Untuk menampilkan kembali nomor yg diinput
    ]);
  }

  public function cetakPdf($id)
  {
    $pendaftar = Pendaftar::findOrFail($id);

    // Ambil path foto dari database
    $pathFoto = $pendaftar->dokumen_foto;

    // Baca file gambar dan ubah ke Base64
    $fullPath = storage_path('app/public/' . $pathFoto);
    $tipeMime = mime_content_type($fullPath);
    $dataGambar = base64_encode(Storage::disk('public')->get($pathFoto));
    $fotoBase64 = 'data:' . $tipeMime . ';base64,' . $dataGambar;

    $data = [
      'siswa' => $pendaftar,
      'tanggal' => date('d M Y'),
      'fotoBase64' => $fotoBase64, // Kirim data gambar Base64 ke view
    ];

    $pdf = PDF::loadView('bukti_pendaftaran_pdf', $data);

    return $pdf->download('bukti-pendaftaran-' . $pendaftar->nomor_pendaftaran . '.pdf');
  }
}
