<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Pilih Tipe Simulasi </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
    </head>
    <body>
        {{-- Logo --}}
        <nav class="navbar sticky-top top-0 bg-white p-4">
            <div class="align-items-center d-flex w-100">
                <div class="d-flex" style="width: 7%; max-height: 70px">
                    <img src="{{ asset('image/logo-ugm-only.svg') }}" class="img-fluid"/>
                </div>
                <div class="d-flex mx-2" style="width: 7%;">
                    <img src="{{ asset('image/logo-trpl.png') }}" class="img-fluid"/>
                </div>
                <div class="d-flex" style="width: 86%;">
                </div>
            </div>
        </nav>

        <div class="container">
            {{-- Title --}}
            <div class="d-flex justify-content-center">
                <div class="d-flex border-bottom border-2 justify-content-center p-2" style="width: 90%">
                    <div class="h2-text p-semi-bold d-flex mt-3 font-blue-dark2">Pilih Jenis Soal</div>
                </div>
            </div>

            {{-- Choices --}}
            <!-- tipe-select -->
            <div class="d-flex flex-row justify-content-evenly mt-3">
                <div class="d-flex flex-column p-lg-5" style="width: 50%;">
                    <img src = "{{ asset('image/type-pusat.svg') }}"/>
                </div>
                <div class="d-flex flex-column m-2 p-lg-5" style="width: 50%;">
                    <img src = "{{ asset('image/daerah-type.svg') }}"/>
                </div>
            </div>
            <div class="d-flex flex-row my-3">
                <div class="d-flex justify-content-center" style="width: 50%;">
                    <a href="{{ route('exam.instruction.pusat') }}" class="btn btn-blue-normal h4-text text-decoration-none">CGAA Pusat</a>
                </div>
                <div class="d-flex justify-content-center" style="width: 50%;">
                    <a href="{{ route('exam.instruction.daerah') }}" class="btn btn-yellow-normal h4-text text-decoration-none">CGAA Daerah</a>
                </div>
            </div>
        </div>
    </body>
</html>