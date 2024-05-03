<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 125px;
            z-index: 1;
            padding-top: 3.5rem;
            background-color: #1a1a1a;
            transition: all 0.3s;
        }

        .sidebar:hover {
            width: 280px;
        }

        .sidebar:hover .nav-link span {
            display: inline;
        }

        .nav-link span {
            display: none;
        }

        .nav-link.active {
            background-color: #343a40 !important;
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
</head>

<body class="bg-secondary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start text-white">
                    <a href="/" class="nav-link text-white">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle">
                                <i class="fs-4 bi-house"></i> <span class="ms-1">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1">Dashboard</span>
                            </a>
                        </li>
                        @auth('operators')
                            <li class="nav-item">
                                <a href="/dashboard/data-pasien" class="nav-link align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1">Data Pasien</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/data-dokter" class="nav-link align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1">Data Dokter</span>
                                </a>
                            </li>
                        @endauth
                        @auth('dokters')
                            <li class="nav-item">
                                <a href="#submenu1" class="nav-link align-middle" data-bs-toggle="collapse">
                                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1">Tindakan</span>
                                </a>
                            </li>
                        @endauth
                    </ul>
                    <div class="dropdown mt-auto">
                        <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownUser1"
                            data-bs-toggle="dropdown">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            @auth('operators')
                                <span
                                    class="d-none d-sm-inline">{{ explode(' ', Auth::guard('operators')->user()->name)[0] }}</span>
                            @endauth
                            @auth('dokters')
                                <span
                                    class="d-none d-sm-inline">{{ explode(' ', Auth::guard('dokters')->user()->name)[0] }}</span>
                            @endauth
                            @auth('web')
                                <span
                                    class="d-none d-sm-inline">{{ explode(' ', Auth::guard('web')->user()->name)[0] }}</span>
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- isi konten -->
            @yield('konten')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
