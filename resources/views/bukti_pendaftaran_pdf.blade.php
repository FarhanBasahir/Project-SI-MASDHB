<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $siswa->nomor_pendaftaran }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0;
        }

        .content {
            margin-top: 20px;
        }

        .content h2 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            width: 30%;
        }

        .footer {
            text-align: right;
            margin-top: 50px;
        }

        .photo {
            width: 113px;
            height: 151px;
            border: 1px solid #000;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>MADRASAH ALIYAH DARUL HUDA BABAI</h1>
            <p>Bukti Pendaftaran Peserta Didik Baru (PPDB)</p>
            <p>Tahun Pelajaran 2025/2026</p>
        </div>

        <div class="content">
            <h2>DATA CALON PESERTA DIDIK</h2>
            <table>
                <tr>
                    <th>Nomor Pendaftaran</th>
                    <td>{{ $siswa->nomor_pendaftaran }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $siswa->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>NISN</th>
                    <td>{{ $siswa->nisn }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Asal Sekolah</th>
                    <td>{{ $siswa->asal_sekolah }}</td>
                </tr>
                <tr>
                    <th>Pas Foto</th>
                    <td>
                        {{-- Menggunakan path absolut ke file di storage --}}
                        <img src="{{ $fotoBase64 }}" alt="Pas Foto" class="photo">
                    </td>
                </tr>
            </table>

            <div class="footer">
                <p>Babai, {{ $tanggal }}</p>
                <br><br><br>
                <p>Panitia PPDB MAS Darul Huda Babai</p>
            </div>
        </div>
    </div>
</body>

</html>
