<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Instruksi Simulasi Pusat</title>
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
                    <div class="h2-text p-semi-bold d-flex mt-3 font-blue-dark2">Instruksi Simulasi Tingkat Pusat</div>
                </div>
            </div>

            {{-- Instruction --}}
            <div class="d-flex justify-content-center flex-column mt-4 px-5" style="width: 90%">
                <div class = "d-flex flex-column">
                    <p class="mb-0">Peserta ujian dilarang melakukan tindakan-tindakan sebagai berikut:</p> 
                        <ol>
                            <li class="ps-3">Mengganggu kelancaran jalannya ujian;</li>
                            <li class="ps-3">Membawa makanan atau minuman serta dilarang merokok di dalam ruangan;</li>
                            <li class="ps-3">Melihat pekerjaan peserta ujian lainnya;</li>
                            <li class="ps-3">Memperlihatkan pekerjaannya kepada peserta lainnya;</li>
                            <li class="ps-3">Berbicara atau berdiskusi satu sama lain;</li>
                            <li class="ps-3">Pinjam meminjam alat tulis satu sama lain;</li>
                            <li class="ps-3">Membawa dan menggunakan kalkulator atau alat hitung lainnya;</li>
                            <li class="ps-3">Membawa contekan dalam bentuk apapun;</li>
                            <li class="ps-3">Membawa atau mempergunakan alat komunikasi, seperti telepon selular, ipad, dan sejenisnya.</li>
                        </ol>    
                </div>
                <div class = "d-flex flex-column">
                    <p class="mb-0">Tips penyelesaian soal kasus penyusunan laporan keuangan:</p> 
                        <ol>
                            <li class="ps-3">Kerjakan semaksimal mungkin yang dapat dikerjakan;</li>
                            <li class="ps-3">Save update pekerjaan secara berkala;</li>
                            <li class="ps-3">Jangan terpaku pada nomenklatur BAS yang terlalu rinci, yang penting substansinya benar;</li>
                            <li class="ps-3">Tuliskan "No Entry" jika transaksi tidak perlu dijurnal.</li>
                        </ol>    
                </div>                                                                                    

            {{-- Button --}}
            <div class="d-flex justify-content-center">
                <div class="row justify-content-center my-4" style="width: 100%">
                    <div class="row me-3" style="width: 40%">
                        <a href="{{ route('exam.type') }}" type="button" class="btn btn-lg btn-outline-blue-normal text-decoration-none">Kembali</a>
                    </div>
                    <form action="{{ route('exam.start') }}" method="POST" class="row ms-3" style="width: 40%">
                        @csrf
                        <input type="hidden" value="pusat" name="exam_type">
                        <button type="submit" class="btn btn-lg btn-blue-normal text-decoration-none">Mulai Simulasi</button>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>