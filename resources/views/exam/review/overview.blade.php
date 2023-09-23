<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGAA | Hasil Ujian</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
    </head>
    <body>
        <div class="container">

            {{-- Logo --}}
            <nav class="navbar sticky-top top-0 bg-white px-4 pt-4">
                <div class="align-items-center d-flex w-100">
                    <div class="d-flex" style="width: 15%; max-height: 70px">
                        <img src="{{ asset('image/logo-ugm-hitam.svg') }}" class="img-fluid"/>
                    </div>
                </div>
            </nav>

            {{-- Title --}}
            <div class="d-flex justify-content-center">
                <div class="d-flex border-bottom border-2 justify-content-center p-2" style="width: 90%">
                    <div class="h2-text p-semi-bold d-flex mt-3 font-blue-dark2">Hasil Ujian</div>
                </div>
            </div>
                                                     
            {{-- Content --}}
            <div class="d-flex justify-content-center">
                <div class="row mt-4" style="width: 90%">
                    <div class="col-lg-4 col-md-6 col-sm-8 mb-2">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center bg-blue-light3 rounded-2 p-3">
                            <p class="h1-text p-semi-bold">{{$result->mp_score}}%</p>
                            <p class="h4-text mb-0">Skor Pilihan Ganda</p>
                            <p class="mb-0">Benar: {{$result->mp_correct}} Salah: {{$result->mp_wrong}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8 mb-2">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center bg-blue-light3 rounded-2 p-3">
                            <p class="h1-text p-semi-bold">{{$result->ey_answered}}</p>
                            <p class="h4-text mb-0">Soal Terjawab</p>
                            <p class="mb-0">Dari 5 soal esai</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8 mb-4">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center bg-blue-light3 rounded-2 p-3">
                            <p class="h1-text p-semi-bold">{{$result->cs_answered}}</p>
                            <p class="h4-text mb-0">Instruksi Terjawab</p>
                            <p class="mb-0">Studi Kasus</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Button --}}
            <div class="d-flex justify-content-center">
                <div class="row my-4" style="width: 90%">
                    <div class="col-lg-3 col-sm-6 mb-1">
                        <div class="d-grid gap-2">
                            <a href="{{ route('exam.review.mp',['session_id'=>$result->id, 'page'=>1]) }}" type="button" class="btn btn-blue-normal">
                                Review Pilihan Ganda
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-1">
                        <div class="d-grid gap-2">
                            <a href="{{ route('exam.review.ey',['session_id'=>$result->id, 'page'=>1]) }}" type="button" class="btn btn-blue-normal">
                                Review Esai
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-1">
                        <div class="d-grid gap-2">
                            <a href="{{ route('exam.review.cs', $result->id) }}" type="button" class="btn btn-blue-normal">
                                Review Studi Kasus
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-1">
                        <div class="d-grid gap-2">
                            <a href="{{ route('user.dashboard') }}" type="button" class="btn btn-yellow-normal">
                                Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>