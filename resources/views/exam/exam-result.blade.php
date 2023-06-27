<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Hasil Simulasi </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    </head>
    <body>
        <div class="container">

            {{-- Logo --}}
            <nav class="navbar sticky-top top-0 bg-white mb-3">
                <div class="container-fluid">
                    <div class="hstack justify-content-between w-100">
                        <div class="w-50"></div>
                        <div>
                            <div class="fs-2 mb-3 flex-row d-flex">        
                                <div class="m-2 d-block p-3 link-dark text-decoration-none" style="width: 260px; height: 50%;">
                                <img src = "{{ asset('image/logo-Vokasi.svg') }}"/></div>
                            </div>
                            </li>
                        </div>
                    </div>                       
                </div>
            </nav>
        
            {{-- Chart --}}
            <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                <div class="col-6 col-lg-4 mb-3">
                    <canvas id="scoreChart"></canvas>
                </div>
                <div class="d-flex text-center">
                    <p class="h3-text p-semi-bold">Selamat, Anda telah menyelesaikan sesi simulasi ini!</p>
                </div>
            </div>
        
            {{-- Result Detail --}}
            <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                <div class="d-flex border-bottom border-2 mb-3" style="width: 90%">
                    <p class="h3-text p-semi-bold m-0">Hasil</p>
                </div>
                <div class="d-flex flex-wrap justify-content-between" style="width: 90%">
                    <div class="d-flex flex-column" style="width: 50%">
                        <p class="h4-text mb-2">Skor: {{ $result->score }}</p>
                        <p class="h4-text mb-2">Soal Terjawab: {{ $result->correct_answer + $result->wrong_answer }}</p>
                    </div>
                    <div class="d-flex flex-column" style="width: 50%">
                        <p class="h4-text mb-2">Benar: {{ $result->correct_answer }}</p>
                        <p class="h4-text mb-2">Salah: {{ $result->wrong_answer }}</p>
                    </div>
                </div>
            </div>
        
            {{-- Button --}}
            <div class="d-flex justify-content-center mb-3">
                <div class="d-flex justify-content-around flex-wrap" style="width: 90%">
                    <div class="row mx-3 mb-2" style="min-width: 30%">
                        <a href="{{route('exam.explanation', ['page' =>1,'session_id' => $result->id ])}}" type="button" class="btn btn-lg btn-yellow-normal">
                            <i class="bi bi-file-earmark-check-fill me-2"></i></i>Review
                        </a>
                    </div>
                    <div class="row mx-3 mb-2" style="min-width: 30%">
                        <a href="{{route('user.dashboard')}}" type="button" class="btn btn-lg btn-blue-normal">
                            <i class="bi bi-house-door-fill me-2"></i>Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            var score = {{ Js::from($score) }}

            const data = {
                labels: ['Skor Anda',''],
                datasets: [{
                    label: '',
                    backgroundColor: ['#f3c700','#dddddd'],
                    data: [score,100-score],
                }]
            };
        
            const config = {
                type: 'doughnut',
                data: data,
                options: {}
            };
        
            const dChart = new Chart(
                document.getElementById('scoreChart'),
                config
            );
        </script>
        <script>
            $(".btn-open").on("click", function(){
                $(".quest-sidebar").addClass("active");
            });
            $(".btn-close").on("click", function(){
                $(".quest-sidebar").removeClass("active");
            });
        </script>
    </body>
</html>