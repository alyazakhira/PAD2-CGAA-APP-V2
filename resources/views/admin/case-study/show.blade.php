<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Simulasi CGAA | Detail Soal Studi Kasus</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/font.css') }}">
        <link rel="stylesheet" href="{{ asset('style/color.css') }}">
        <link rel="stylesheet" href="{{ asset('style/button.css') }}">
        <style>
            tbody, td, tfoot, th, thead, tr{
                padding: 0.3rem;
                border-width: 1px
            }
        </style>
    </head>
    <body class="d-flex">

        {{-- Sidebar --}}
        <div class="d-flex flex-column bg-yellow-normal1 p-4 vh-100 align-items-center sidebar sticky-top flex-shrink-0 left-sidebar overflow-y-scroll">
            {{-- Logo --}}
            <div class="d-flex justify-content-between justify-content-lg-center align-items-center w-100 mb-5">
                {{-- Logo --}}
                <a href="/" class="d-flex align-items-center justify-content-center text-white" style="width: 80%; padding: 5px;">
                    <img src="{{ asset('image/logo-ugm-hitam.svg') }}" style="width: 100%"/>
                </a>
                {{-- Close button --}}
                <button class="btn btn-close d-flex d-block align-self-start d-lg-none"></button>
            </div>
            {{-- Menus --}}
            <div class="nav nav-pills d-flex flex-column w-100">
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.dashboard') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-house-door text-white"></i>
                    </div>
                    <p class="font-blue-dark3 m-0 par-text">Dashboard</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.user.index', 1) }}">
                    <div class="d-flex  rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-file-earmark-person text-white"></i>
                    </div>
                    <p class="font-blue-dark3 m-0 par-text">Pengguna Situs</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.ey.index.pusat', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-list-stars text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Pilihan Ganda Pusat</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.mp.index.daerah', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-list-task text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Pilihan Ganda Daerah</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.mp.create') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-clipboard-plus text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Tambah Pilihan Ganda</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.ey.index.pusat', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-file-earmark-richtext text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Esai Pusat</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.ey.index.daerah', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-file-earmark-text text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Esai Daerah</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.ey.create') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-file-earmark-plus text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Tambah Esai</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.cs.index.pusat', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-journal-richtext text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Studi Kasus Pusat</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.cs.index.daerah', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-journal-text text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Studi Kasus Daerah</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('admin.cs.create') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-journal-plus text-white"></i>
                    </div>
                    <p class="font-blue-dark3 par-text m-0">Tambah Studi Kasus</p>
                </a>
            </div>
        </div>

        <main class="d-flex flex-column max-vh-100 ps-5 pe-5 pb-5 pt-3 w-100">
            {{-- Navbar --}}
            <nav class="nav navbar bg-white p-0">
                <div class="container-fluid p-0">
                    <button class="navbar-brand btn btn-open d-lg-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                    <div></div>
                    <div class="navbar-brand me-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-decoration-none d-flex font-yellow-dark4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2 d-none d-lg-block align-self-center font-yellow-dark4" id="username">Admin</span>
                                <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-yellow-dark4 text-white" style="width: 2.5rem; height: 2.5rem;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                <li>
                                    <form action={{ route('logout') }} method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Keluar</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>

            <div class="d-flex flex-column">
                {{-- Header --}}
                <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium mb-4">
                    <p class="mb-1 d-none d-lg-block"> ID Soal: {{ $cs->id }}</p>
                </div>
                
                {{-- Information --}}
                <div class="d-flex flex-column mb-3">
                    <div class="label-text mb-3">{!! $cs->information !!}</div>
                </div>

                {{-- Instruction and Key --}}
                @for ($i = 1; $i <= $cs->instruction_count; $i++)
                    <div class="d-flex flex-column border border-black rounded-1 p-3 my-3">
                        <p class="p-semi-bold mb-1">Instruksi {{ $i }}</p>
                        <div class="label-text d-flex flex-column mb-3">{!! $cs->{"instruction_$i"} !!}</div>
                        <p class="p-semi-bold mb-1">Kunci Jawaban {{ $i }}</p>
                        <div class="label-text d-flex flex-column">{!! $cs->{"key_answer_$i"} !!}</div>
                    </div>
                @endfor

                {{-- Action --}}
                <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium my-4">
                    <p class="mb-1 d-none d-lg-block"> Aksi Lanjutan</p>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.cs.edit', $cs->id) }}" type="button" class="btn btn-blue-dark"><i class="bi bi-pencil-fill me-3"></i>Ubah Soal Ini</a>
                    <form class="d-grid" action="{{route('admin.cs.delete', $cs->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill me-3"></i>Hapus Soal Ini</button>
                    </form>
                    <a href="{{ route('admin.cs.create') }}" type="button" class="btn btn-success"><i class="bi bi-file-earmark-plus-fill me-3"></i>Tambah Soal Baru</a>
                </div>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(".btn-open").on("click", function(){
                $(".left-sidebar").addClass("active");
            });
            $(".btn-close").on("click", function(){
                $(".left-sidebar").removeClass("active");
            });
        </script>
    </body>
</html>