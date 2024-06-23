<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penilaian Pegawai</title>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="{{ asset('../images/logokemenag.jpg') }}" alt="Logo" height="65"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="/dashboard">Home</a>
                        <a class="nav-link " href="/data-pegawai">Data Pegawai</a>
                        <a class="nav-link active" href="penilaian-pegawai">Penilaian Pegawai</a>
                        <a class="nav-link" href="/kuadran">Kuadran</a>
                    </div>
                </div>
                @auth
                    <div class="navbar-nav">
                        <span class="nav-link">Selamat Datang, {{ Auth::user()->name }}!</span>
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endauth
            </div>
        </nav>
        <div class="content container mt-4">
            <h2>Penilaian Pegawai</h2>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPenilaianModal">
                Tambah Penilaian
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Tahun Penilaian</th>
                        <th>Kegiatan</th>
                        <th>Nilai</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penilaian as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->tahun_penilaian }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            <td>{{ $data->nilai }}</td>
                            <td>{{ $data->note }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPenilaianModal{{ $data->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('penilaian.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

  <!-- Modal Tambah Penilaian -->
<div class="modal fade" id="addPenilaianModal" tabindex="-1" aria-labelledby="addPenilaianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPenilaianModalLabel">Tambah Penilaian Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_penilaian" class="form-label">Tahun Penilaian</label>
                        <input type="number" class="form-control" id="tahun_penilaian" name="tahun_penilaian" required>
                    </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <select class="form-select" id="nilai" name="nilai" required>
                            <option value="Baik">Baik</option>
                            <option value="Cukup Baik">Cukup Baik</option>
                            <option value="Kurang Baik">Kurang Baik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input type="textarea" class="form-control" id="note" name="note" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Penilaian -->
@foreach ($penilaian as $data)
<div class="modal fade" id="editPenilaianModal{{ $data->id }}" tabindex="-1" aria-labelledby="editPenilaianModal{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPenilaianModal{{ $data->id }}">Edit Penilaian Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penilaian.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $data->nip }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_penilaian" class="form-label">Tahun Penilaian</label>
                        <input type="number" class="form-control" id="tahun_penilaian" name="tahun_penilaian" value="{{ $data->tahun_penilaian }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="{{ $data->kegiatan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <select class="form-select" id="nilai" name="nilai" required>
                            <option value="Baik" {{ ($data->nilai == 'Baik') ? 'selected' : '' }}>Baik</option>
                            <option value="Cukup Baik" {{ ($data->nilai == 'Cukup Baik') ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="Kurang Baik" {{ ($data->nilai == 'Kurang Baik') ? 'selected' : '' }}>Kurang Baik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input type="text" class="form-control" id="note" name="note" value="{{ $data->note }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
