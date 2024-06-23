<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pegawai</title>
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
                        <a class="nav-link active " href="/data-pegawai">Data Pegawai</a>
                        <a class="nav-link " href="penilaian-pegawai">Penilaian Pegawai</a>
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
        <div class="content">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container mt-5">
                <h2>Data Pegawai</h2>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPegawaiModal">Tambah Pegawai</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Unit Kerja</th>
                            <th>Pangkat Golongan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $counter = 1;
                        @endphp
                        @foreach($pegawai as $data)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->tanggal_lahir }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->agama }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->jabatan }}</td>
                            <td>{{ $data->unit_kerja }}</td>
                            <td>{{ $data->pangkat_golongan }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editPegawaiModal{{ $data->id }}">
                                        <i class="bi bi-pencil-square"></i></button>
                                    <form action="/delete-pegawai/{{ $data->id }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?');">
                                            <i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            
                        </tr>
                        @php
                        $counter++;
                         @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to add employee -->
                    <form action="/submit-data-pegawai" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" name="agama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_kerja" class="form-label">Unit Kerja</label>
                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="pangkat_golongan" class="form-label">Pangkat Golongan</label>
                            <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal Edit Pegawai -->
    @foreach($pegawai as $data)
    <div class="modal fade" id="editPegawaiModal{{ $data->id }}" tabindex="-1" aria-labelledby="editPegawaiModalLabel{{ $data->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPegawaiModalLabel{{ $data->id }}">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit employee -->
                    <form action="/update-pegawai/{{ $data->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nip{{ $data->id }}" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip{{ $data->id }}" name="nip" value="{{ $data->nip }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama{{ $data->id }}" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama{{ $data->id }}" name="nama" value="{{ $data->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir{{ $data->id }}" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir{{ $data->id }}" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin{{ $data->id }}" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin{{ $data->id }}" name="jenis_kelamin" required>
                                <option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="agama{{ $data->id }}" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama{{ $data->id }}" name="agama" value="{{ $data->agama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat{{ $data->id }}" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat{{ $data->id }}" name="alamat" rows="3" required>{{ $data->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp{{ $data->id }}" class="form-label">No. HP</label>
                            <input type="tel" class="form-control" id="no_hp{{ $data->id }}" name="no_hp" value="{{ $data->no_hp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email{{ $data->id }}" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email{{ $data->id }}" name="email" value="{{ $data->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan{{ $data->id }}" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan{{ $data->id }}" name="jabatan" value="{{ $data->jabatan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_kerja{{ $data->id }}" class="form-label">Unit Kerja</label>
                            <input type="text" class="form-control" id="unit_kerja{{ $data->id }}" name="unit_kerja" value="{{ $data->unit_kerja }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pangkat_golongan{{ $data->id }}" class="form-label">Pangkat Golongan</label>
                            <input type="text" class="form-control" id="pangkat_golongan{{ $data->id }}" name="pangkat_golongan" value="{{ $data->pangkat_golongan }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    @endforeach

</body>
</html>
