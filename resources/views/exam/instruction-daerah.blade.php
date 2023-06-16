<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Instruksi Simulasi Daerah</title>
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
                    <div class="h2-text p-semi-bold d-flex mt-3 font-yellow-dark2">Instruksi Simulasi Tingkat Daerah</div>
                </div>
            </div>

            {{-- Instruction --}}
            <div class="d-flex flex-column mt-4 px-5">
                <ol>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                    <li class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis tincidunt velit vitae laoreet. 
                        Etiam id facilisis ipsum, eu pellentesque dolor.</li>
                </ol>
            </div>

            {{-- Button --}}
            <div class="d-flex justify-content-center">
                <div class="row justify-content-center my-4" style="width: 100%">
                    <div class="row me-3" style="width: 40%">
                        <a href="{{ route('exam.type') }}" type="button" class="btn btn-lg btn-outline-yellow-dark text-decoration-none">Kembali</a>
                    </div>
                    <form action="{{ route('exam.start') }}" method="POST" class="row ms-3" style="width: 40%">
                        @csrf
                        <input type="hidden" value="daerah" name="exam_type">
                        <button type="submit" class="btn btn-lg btn-yellow-normal text-decoration-none">Mulai Simulasi</button>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>