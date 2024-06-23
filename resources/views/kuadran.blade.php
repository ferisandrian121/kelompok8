<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kuadran</title>
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
                        <a class="nav-link " href="penilaian-pegawai">Penilaian Pegawai</a>
                        <a class="nav-link active" href="/kuadran">Kuadran</a>
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
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Data Kuadran</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
            Tambah Data
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Hasil Kerja</th>
                    <th>Perilaku Kerja</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuadran as $data)
                <tr>
                    <td>{{ $data->nip }}</td>
                    <td>{{ $data->hasil_kerja }}</td>
                    <td>{{ $data->perilaku_kerja }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                            <i class="bi bi-pencil"></i> <!-- Ikon untuk Edit -->
                        </button>
                        <form action="{{ route('kuadran.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?');">
                                <i class="bi bi-trash"></i> <!-- Ikon untuk Hapus -->
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk tambah data -->
                    <form action="{{ route('kuadran.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="hasilKerja" class="form-label">Hasil Kerja</label>
                            <input type="number" class="form-control" id="hasilKerja" name="hasil_kerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="perilakuKerja" class="form-label">Perilaku Kerja</label>
                            <input type="number" class="form-control" id="perilakuKerja" name="perilaku_kerja" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($kuadran as $data)
    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk edit data -->
                    <form action="{{ route('kuadran.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nipEdit" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nipEdit" name="nip" value="{{ $data->nip }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="hasilKerjaEdit" class="form-label">Hasil Kerja</label>
                            <input type="number" class="form-control" id="hasilKerjaEdit" name="hasil_kerja" value="{{ $data->hasil_kerja }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="perilakuKerjaEdit" class="form-label">Perilaku Kerja</label>
                            <input type="number" class="form-control" id="perilakuKerjaEdit" name="perilaku_kerja" value="{{ $data->perilaku_kerja }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</body>
</html>
