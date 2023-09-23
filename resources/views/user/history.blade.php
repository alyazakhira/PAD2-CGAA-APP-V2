<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simulasi CGAA | Riwayat </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('style/font.css') }}">
        <link rel="stylesheet" href="{{ asset('style/color.css') }}">
        <link rel="stylesheet" href="{{ asset('style/button.css') }}">
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    </head>
    <body class="d-flex">
        {{-- Sidebar --}}
        <div class="d-flex flex-column bg-blue-dark1 p-4 vh-100 align-items-center sidebar sticky-top flex-shrink-0 left-sidebar">
            {{-- Header --}}
            <div class="d-flex flex-row justify-content-between justify-content-lg-center align-items-center w-100 mb-5">
                {{-- Logo --}}
                <div class="d-flex align-items-center justify-content-center" style="width: 80%; padding: 5px;">
                    <img src="{{ asset('image/logo-ugm-putih.svg') }}" style="width: 100%"/>
                </div>
                {{-- Close button --}}
                <button class="btn btn-close d-flex d-block align-self-start d-lg-none"></button>
            </div>

            {{-- Menu --}}
            <div class="nav nav-pills d-flex flex-column w-100">
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('user.dashboard') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-yellow-light3 me-2 circle-bg">
                        <i class="bi bi-house-door-fill text-black"></i>
                    </div>
                    <p class="font-yellow-light3 m-0 par-text">Dashboard</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none mb-3" href="{{ route('user.history') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-yellow-light3 me-2 circle-bg">
                        <i class="bi bi-file-earmark-check-fill text-black"></i>
                    </div>
                    <p class="font-yellow-light3 par-text m-0">Riwayat Simulasi</p>
                </a>
            </div>
        </div>

        {{-- Outside of Sidebar --}}
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
                            <a class="nav-link dropdown-toggle text-decoration-none d-flex" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2 d-none d-lg-block align-self-center font-blue-dark1" id="username">{{ $user->name }}</span>
                                <div class="d-flex rounded-circle circle-bg p-1 align-items-center justify-content-center bg-blue-dark1 text-white">
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
    
            {{-- Title --}}
            <h1 class="h3-text font-blue-dark1 p-semi-bold mb-3">Riwayat Pengerjaan</h1>

            {{-- History Wrapper --}}
            <div class="d-flex flex-column w-100 bg-blue-dark1 p-4" style="height: 90%">
                
                {{-- History item --}}
                @if ($session == null)
                    <div class="d-flex text-white h4-text">
                        Anda belum melakukan simulasi.
                    </div>
                @else
                    @foreach ($session as $s)
                        <a href="{{route('exam.result', $s->id)}}" class="d-flex bg-yellow-light3 p-3 justify-content-between mb-2 text-decoration-none text-black rounded-2">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chevron-right font-blue-dark1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                <div class="mx-3 d-flex flex-column">
                                    <p class="p-medium mb-1">{{ date('d-m-Y H:i:s', strtotime($s->created_at)) }}</p>
                                    <p class="additional-text m-0">Tingkat {{ $s->type }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-end me-2">
                                <p class="m-0 p-semi-bold font-blue-dark1">Review</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </main>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
