<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simulasi CGGA | Dashboard </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('style/font.css') }}">
        <link rel="stylesheet" href="{{ asset('style/color.css') }}">
        <link rel="stylesheet" href="{{ asset('style/button.css') }}">
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    </head>
    <body class="d-flex">
        {{-- Sidebar --}}
        <div class="d-flex flex-column bg-blue-dark1 p-4 vh-100 justify-content-between align-items-center sidebar sticky-top flex-shrink-0 left-sidebar">
            <div class="d-flex flex-row justify-content-between justify-content-lg-center align-items-center w-100">
                {{-- Logo --}}
                <div class="d-flex align-items-center justify-content-center" style="width: 70%; padding: 5px;"><img src = "{{ asset('image/logoVokasi-admin.svg') }}"/></div>
                {{-- Close button --}}
                <button class="btn btn-close d-flex d-block align-self-start d-lg-none"></button>
            </div>
            {{-- Middle --}}
            <div class="nav nav-pills d-flex flex-column w-100">
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none" href="{{ route('user.dashboard') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-yellow-light3 me-2 circle-bg">
                        <i class="bi bi-house-door-fill text-black"></i>
                    </div>
                    <p class="font-yellow-light3 m-0 h4-text">Dashboard</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none my-5" href="{{ route('user.history') }}">
                    <div class="d-flex rounded-circle p-1 align-items-center justify-content-center bg-yellow-light3 me-2 circle-bg">
                        <i class="bi bi-file-earmark-check-fill text-black"></i>
                    </div>
                    <p class="font-yellow-light3 h4-text m-0">Riwayat</p>
                </a>
                <a class="nav-item d-flex align-items-center w-100 text-decoration-none" href="/under-development">
                    <div class="d-flex  rounded-circle p-1 align-items-center justify-content-center bg-yellow-light3 me-2 circle-bg">
                        <i class="bi bi-bell-fill text-black"></i>
                    </div>
                    <p class="font-yellow-light3 m-0 h4-text">Notifikasi</p>
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
                                <div class="d-flex rounded-circle circle-bg p-1 align-items-center justify-content-center bg-blue-dark1 me-2 text-white">
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
            <p class="h3-text font-blue-dark1 p-semi-bold">Statistik Skor</p>
    
            {{-- Chart --}}
            <div class="d-flex justify-content-between flex-wrap" id="charts">
                <div class="d-flex flex-column align-items-center mb-2" style="width: 60%">
                    <canvas class="d-flex mb-2" id="lineChart"></canvas>
                    <p class="par-text">Riwayat Skor</p>
                </div>
                <div class="d-flex flex-column align-items-center" style="width: 30%">
                    <canvas class="d-flex mb-2" id="doughnutChart"></canvas>
                    <p class="par-text">Skor Rata-rata</p> 
                </div>
            </div>
    
            {{-- Latest History --}}
            <p class="h3-text font-blue-dark1 p-semi-bold">Riwayat Terbaru</p>
            <div class="d-flex justify-content-between justify-content-xxl-start flex-wrap mb-5">
                @if ($latestPusat == null)
                    <div class="d-flex flex-column bg-blue-dark1 p-2 mb-2 me-xxl-4" style="width: 47%">
                        <div class="d-flex flex-column mt-2">
                            <p class="par-text font-yellow-light3 m-0">Riwayat Simulasi Tingkat Pusat</p>
                            <p class="label-text font-yellow-light3">Anda belum melakukan simulasi tingkat pusat.</p>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <p class="label-text text-white m-0">Skor: --</p>
                            <p class="label-text text-white m-0">Benar: --</p>
                            <p class="label-text text-white m-0">Salah: --</p>
                        </div> 
                    </div>
                @else
                    <a href="{{route('exam.explanation', ['page' =>1,'session_id' => $latestPusat->id ])}}" class="d-flex flex-column bg-blue-dark1 p-2 mb-2 me-xxl-4 text-decoration-none" style="width: 47%">
                        <div class="d-flex flex-column mt-2">
                            <p class="par-text font-yellow-light3 m-0">Riwayat Simulasi Tingkat Pusat</p>
                            <p class="label-text font-yellow-light3">{{ date('d-m-Y H:i:s',strtotime($latestPusat->created_at)) }}</p>
                        </div>
                        <div class="d-flex flex-column mb-2">
                            <p class="label-text text-white m-0">Skor: {{ $latestPusat->score }}</p>
                            <p class="label-text text-white m-0">Benar: {{ $latestPusat->correct_answer }}</p>
                            <p class="label-text text-white m-0">Salah: {{ $latestPusat->wrong_answer }}</p>
                        </div> 
                    </a>
                @endif

                @if ($latestDaerah == null)
                    <div class="d-flex flex-column bg-blue-dark1 p-2 mb-2 me-xxl-4" style="width: 47%">
                        <div class="d-flex flex-column mt-2">
                            <p class="par-text font-yellow-light3 m-0">Riwayat Simulasi Tingkat Daerah</p>
                            <p class="label-text font-yellow-light3">Anda belum melakukan simulasi tingkat daerah.</p>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="label-text text-white m-0">Skor: --</p>
                            <p class="label-text text-white m-0">Benar: --</p>
                            <p class="label-text text-white m-0">Salah: --</p>
                        </div>
                    </div>
                @else
                    <a href="{{route('exam.explanation', ['page' =>1,'session_id' => $latestDaerah->id ])}}" class="d-flex flex-column bg-blue-dark1 p-2 mb-2 me-xxl-4 text-decoration-none" style="width: 47%">
                        <div class="d-flex flex-column mt-2">
                            <p class="par-text font-yellow-light3 m-0">Riwayat Simulasi Tingkat Daerah</p>
                            <p class="label-text font-yellow-light3">{{ date('d-m-Y H:i:s',strtotime($latestDaerah->created_at)) }}</p>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="label-text text-white m-0">Skor: {{ $latestDaerah->score }}</p>
                            <p class="label-text text-white m-0">Benar: {{ $latestDaerah->correct_answer }}</p>
                            <p class="label-text text-white m-0">Salah: {{ $latestDaerah->wrong_answer }}</p>
                        </div>
                    </a>
                @endif
            </div>

            {{-- Start Test Button --}}
            <div class="d-flex bg-blue-dark1 justify-content-between align-items-center p-2 flex-wrap">
                <p class="par-text text-white mb-md-0">Kunci keberhasilan adalah berlatih secara konsisten!</p>
                <a class="d-flex align-items-center justify-content-end bg-yellow-normal1 py-1 px-2 rounded-pill text-decoration-none text-black" href="{{ route('exam.type') }}">
                    <p class="p-semi-bold my-0 me-2">Mulai Simulasi</p>
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </main>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            var labels = {{ Js::from($date) }};
            var value = {{ Js:: from($score) }};
            if (value[0] == null) {
                value = 0;
            }
            var avg = {{ Js::from($average) }}
    
            // line chart
            const data1 = {
                labels: labels,
                datasets: [{
                    label: 'Skor',
                    backgroundColor: '#434ed7',
                    borderColor: '#434ed7',
                    data: value,
                }]
            };
            const config1 = {
                type: 'line',
                data: data1,
                options: {}
            };
            const lineChart = new Chart(
                document.getElementById('lineChart'),
                config1
            );
    
            // doughnut chart
            const data2 = {
                labels: ['Rata-rata Anda',''],
                datasets: [{
                    label: '',
                    backgroundColor: ['#f3c700','#dddddd'],
                    data: [avg,100-avg],
                }]
            };
        
            const config2 = {
                type: 'doughnut',
                data: data2,
                options: {}
            };
        
            const dChart = new Chart(
                document.getElementById('doughnutChart'),
                config2
            );
        </script>
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
