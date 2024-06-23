<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
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
                        <a class="nav-link  active" aria-current="page" href="/dashboard">Home</a>
                        <a class="nav-link " href="/data-pegawai">Data Pegawai</a>
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
            <div class="container">
                <h1 class="mt-5 mb-4">Selamat Datang di Penilaian SKP, @auth {{ Auth::user()->name }}! @endauth</h1>
                <p>Terima kasih atas partisipasi Anda dalam penilaian SKP. Silakan pilih menu untuk melanjutkan.</p>
                <!-- Your content here -->
            </div>
        </div>
    </div>
</body>
</html>
