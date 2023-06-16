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
        <div class="container">

            {{-- Logo --}}
            <nav class="navbar sticky-top top-0 bg-white">
                <div class="container-fluid">
                    <div class="hstack justify-content-between w-100">
                        <div class="w-50"></div>
                        <div>
                            <div class="fs-2 mb-3 flex-row d-flex">        
                                <div class="m-2 d-block p-3 link-dark text-decoration-none bg-blue-dark1" style="width: 260px; height: 50%;"></div>
                            </div>
                            </li>
                        </div>
                    </div>                       
                </div>
            </nav>

            {{-- Title --}}
            <div class="d-flex justify-content-center">
                <div class="d-flex border-bottom border-2 justify-content-center p-2" style="width: 90%">
                    <div class="h2-text p-semi-bold d-flex mt-3 font-blue-dark2">Pilih Jenis Soal</div>
                </div>
            </div>

            {{-- Choices --}}
            <div class="d-flex justify-content-between my-5" style="width: 90%">
                <div class="d-flex flex-column align-items-center images" style="width: 45%">
                    <div class="d-grid">
                        <img src="image/ujian-kuning.jpg" class="img-fluid align-items-center mb-4">
                        <a href="{{ route('exam.instruction.pusat') }}" class="btn btn-blue-normal h3-text text-decoration-none">CGAA Pusat</a>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center images" style="width: 45%">
                    <div class="d-grid">
                        <img src="image/ujian-biru.jpg" class="img-fluid align-items-center mb-2">
                        <a href="{{ route('exam.instruction.daerah') }}" class="btn btn-yellow-normal h3-text text-decoration-none">CGAA Daerah</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>