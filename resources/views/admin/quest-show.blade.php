<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | Lihat Soal</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/font.css') }}">
        <link rel="stylesheet" href="{{ asset('style/color.css') }}">
        <link rel="stylesheet" href="{{ asset('style/button.css') }}">
    </head>
    <body class="d-flex">

        {{-- Sidebar --}}
        <div class="d-flex flex-column bg-yellow-normal1 p-4 vh-100 justify-content-between align-items-center sidebar sticky-top flex-shrink-0 left-sidebar">
            <div class="d-flex flex-row justify-content-between justify-content-lg-center align-items-center w-100">
                {{-- Logo --}}
                <div class="d-flex align-items-center justify-content-center text-white" style="width: 80%; padding: 5px;">
                    <img src="{{ asset('image/logo-ugm-hitam.svg') }}" style="width: 100%"/>
                </div>
                {{-- Close button --}}
                <button class="btn btn-close d-flex d-block align-self-start d-lg-none"></button>
            </div>
            {{-- Middle --}}
            <div class="nav nav-pills d-flex flex-column w-100">
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none" href="{{ route('admin.dashboard') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-house-door-fill text-white"></i>
                    </div>
                    <p class="font-blue-dark3 m-0 h4-text">Dashboard</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none my-5" href="{{ route('admin.question.index', 1) }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-file-earmark-text-fill text-white"></i>
                    </div>
                    <p class="font-blue-dark3 h4-text m-0">Soal Simulasi</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none" href="{{ route('admin.user.index', 1) }}">
                    <div class="d-flex  rounded-circle p-1 align-items-center justify-content-center bg-blue-dark3 me-2" style="width: 2.5rem; height: 2.5rem;">
                        <i class="bi bi-file-earmark-person-fill text-white"></i>
                    </div>
                    <p class="font-blue-dark3 m-0 h4-text">Pengguna Situs</p>
                </a>
            </div>
            {{-- Bottom --}}
            <div class="d-flex align-items-center w-100 text-decoration-none" href="#">
                {{-- <div class="d-flex  rounded-circle p-1 align-items-center justify-content-center bg-yellow-light3 me-2 circle-bg">
                    <i class="bi bi-gear-fill text-black"></i>
                </div>
                <p class="font-yellow-light3 m-0 h4-text">Pengaturan</p> --}}
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
                                <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-yellow-dark4 me-2 text-white" style="width: 2.5rem; height: 2.5rem;">
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
                    <p class="mb-1 d-none d-lg-block"> ID Soal: {{ $mp->id }}</p>
                </div>
                
                {{-- Question --}}
                <div class="d-flex flex-column mb-3">
                    <div class="h4-text mb-3">{!! $mp->question !!}</div>

                    {{-- Choice A --}}
                    <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                        <input type="radio" name="answer" id="answer1" class="d-none radio-button" value="a">
                        <label for="answer1" class="me-3 radio-tile">
                            <span class="d-flex align-items-center justify-content-center p-medium radio-label">A</span>
                        </label>
                        <div class="d-flex flex-column w-100 choice">{!! $mp->answer_a !!}</div>
                        <!-- <p class="choice" style="color:black">{!! $mp->answer_a !!}</p> -->
                    </div>

                    {{-- Choice B --}}
                    <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                        <input type="radio" name="answer" id="answer2" class="d-none radio-button" value="b">
                        <label for="answer2" class="me-3 radio-tile">
                            <span class="d-flex btn-blue-light align-items-center justify-content-center p-medium radio-label">B</span>
                        </label>
                        <div class="d-flex flex-column w-100 choice">{!! $mp->answer_b !!}</div>
                    </div>

                    {{-- Choice C --}}
                    <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                        <input type="radio" name="answer" id="answer3" class="d-none radio-button" value="c">
                        <label for="answer3" class="me-3 radio-tile">
                            <span class="d-flex align-items-center justify-content-center p-medium radio-label">C</span>
                        </label>
                        <div class="d-flex flex-column w-100 choice">{!! $mp->answer_c !!}</div>
                    </div>

                    {{-- Choice D --}}
                    <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                        <input type="radio" name="answer" id="answer4" class="d-none radio-button" value="d">
                        <label for="answer4" class="me-3 radio-tile">
                            <span class="d-flex bg-blue-light3 align-items-center justify-content-center p-medium radio-label">D</span>
                        </label>
                        <div class="d-flex flex-column w-100 choice">{!! $mp->answer_d !!}</div>
                    </div>
                </div>

                {{-- Explanation --}}
                <div class="d-flex flex-column border border-black rounded-1 p-3 my-3">
                    <p class="h4-text p-semi-bold">Penjelasan Soal</p>
                    <div class="d-flex flex-column mb-2">{!! $mp->question_explanation !!}</div>
                    <p class="p-medium m-0">Jawaban benar: {{ $mp->correct_answer }}</p>
                </div>

                {{-- Action --}}
                <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium my-4">
                    <p class="mb-1 d-none d-lg-block"> Aksi Lanjutan</p>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.question.edit', $mp->id) }}" type="button" class="btn btn-blue-dark"><i class="bi bi-pencil-fill me-3"></i>Ubah Soal Ini</a>
                    <form class="d-grid" action="{{route('admin.question.delete', $mp->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill me-3"></i>Hapus Soal Ini</button>
                    </form>
                    <a href="{{ route('admin.question.create') }}" type="button" class="btn btn-success"><i class="bi bi-file-earmark-plus-fill me-3"></i>Tambah Soal Baru</a>
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