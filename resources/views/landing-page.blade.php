<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Meta and Title --}}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi CGAA</title>

    {{-- Online-based Stylesheet --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    {{-- Local-based Stylesheet --}}
    <link rel="stylesheet" href={{ asset('style/font.css') }}>
    <link rel="stylesheet" href={{ asset('style/button.css') }}>
    <link rel="stylesheet" href={{ asset('style/color.css') }}>

    {{-- Document-based Stylesheet --}}
    <style>
        .card {
        width: 230px;
        height: 200px;
        background: #FBEEB0;
        overflow: visible;
        display: flex;
        flex-direction: column;
        align-items: center;
        }
    
        .card-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0 1rem;
        }
    
        .card-img {
        --size: 70px;
        width: var(--size);
        height: var(--size);
        border-radius: 50%;
        transform: translateY(-50%);
        background: #434ED7;
        position: relative;
        color: #fff;
        font-size: 1.5rem;
        padding: 1rem 1rem;   
        }
    
        .card-img::before {
        content: "";
        border-radius: inherit;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 90%;
        height: 90%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 1.5rem;
        padding: 1rem 1rem;
        text-align: center;
        }
    </style>
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg sticky-top bg-yellow-normal1 p-0">
    <div class="container-fluid">
        <a href="/" class="navbar-brand ms-4 my-3" href="#">Simulasi US-CGAA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end mx-4 nav-item" id="navbarSupportedContent">
            <div class="navbar-nav mb-2 mb-lg-0">
                <div class="nav-item m-2 d-grid">
                    @if (session()->has('user'))
                        @if (session('authorized'))
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-blue-dark text-white" type="button">Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-blue-dark text-white" type="button">Dashboard</a>
                        @endif
                    @else
                        <a href="/sign-in" class="btn btn-blue-dark text-white" type="button">Login</a>
                    @endif
                </div>
                <div class="nav-item m-2 d-grid">
                    @if (session()->has('bearer'))
                        <form action={{ route('logout') }} method="POST" class="d-grid" style="width: 100%">
                            @csrf
                            <button type="submit" class="btn btn-outline-blue-dark">Keluar</button>
                        </form>
                    @else
                        <a href="/sign-up" class="btn btn-outline-blue-dark" type="button">Daftar</a> 
                    @endif
                </div>
            </div>   
        </div>
    </div>
</nav>
<!--Akhir Navbar-->

<!--Header-->
<div class="container-fluid px-5">
    <div class="p-2 p-md-5 mb-4 pt-4 bg-yellow-light2">
        <div class="col align-items-center">
            <p class="sub-display-text text-center"><strong>Simulasi <span class="font-blue-normal3">US-CGAA</span></strong></p>
            <p class="my-3 header-3 text-center"> US-CGGAA atau Ujian Sertifikasi <i>Certified Government Accounting Associate</i> merupakan sebuah wadah simulasi untuk mengukur
                kemampuan mahasiswa sebelum mengikuti ujian sertifikasi resmi. Aplikasi teknologi ini dirancang 
                untuk persiapan ujian sertifikasi kompetensi ahli akuntansi pemerintahan dengan penilaian secara real-time sehingga diharapkan dapat meminimalkan risiko tidak lulusnya ujian. 
                Sertifikasi kompetensi tersebut dapat dimiliki oleh mahasiswa program studi Sarjana Terapan Akuntansi 
                Sektor Publik di Pendidikan Vokasi. Sertifikat ini dapat menjadi bukti keunggulan kompetitif mahasiswa dan siap terjun ke dunia industri. 
            </p>
        </div>
    </div>
<!--Akhir Header-->

<!--Tagline-->
    <div class="d-flex p-2 flex-row justify-content-center align-items-center bg-blue-dark2">
        <p class="h3-text p-medium m-0 text-center text-white"><i>"Practice makes perfect"</i></p>
    </div>
<!--Akhir Tagline-->

<!--Jenis simulasi-->
<div class="container marketing">
    <div class="row featurette mt-5 justify-content-between">
        <div class="col-md-6 order-md-2 m-3">
            <h2 class="h2-text fw-bold">Simulasi Ujian Tingkat Pusat</h2>
            <p class="lead par-text my-2">
            Sertifikasi kompetensi akuntansi pemerintahan pusat akan menilai pemahaman atas peraturan perundang- undangan keuangan negara, 
            standar akuntansi pemerintahan, serta kebijakan akuntansi dan sistem akuntansi pemerintah pusat.
            </p>
        </div>
        <div class="col-md-5 order-md-1 my-3">
            <img src="image/ujian-kuning.jpg" class="img-fluid">
        </div> 
    </div>

    <div class="row featurette my-5 justify-content-between">
        <div class="col-md-6">
            <h2 class="h2-text fw-bold my-3">Simulasi Ujian Tingkat Daerah</h2>
            <p class="lead par-text my-2">
            Sertifikasi kompetensi akuntansi pemerintahan daerah akan menguji pemahaman mahasiswa terkait peraturan perundang-undangan keuangan
             negara, standar akuntansi pemerintahan, serta kebijakan akuntansi dan sistem akuntansi pemerintah daerah.
            </p>
        </div>
        <div class="col-md-5 my-3">
            <img src="image/ujian-biru.jpg" class="img-fluid">
        </div>
    </div>

    <div class="row">
        @if (session()->has('user'))
            <a href="{{ route('exam.type') }}" class="btn btn-blue-dark btn-lg" type="button">Mulai Simulasi Sekarang!</a>
        @else
            <a href="{{ route('register.show') }}" class="btn btn-blue-dark btn-lg" type="button">Mulai Simulasi Sekarang!</a>
        @endif
        
    </div>
</div>
<!-- Akhir Jenis -->

<!--Langkah-langkah-->
<h2 class="text-center fw-bold lh-1 mt-5 mb-3">Langkah-langkah</h2>

<div class="d-flex flex-wrap align-items-top justify-content-md-around justify-content-center pt-5">
    <div class="d-flex mb-5">
        <div class="card h-100">
            <div class="card-img d-flex align-items-center justify-content-center">1</div>
            <div class="card-info">
                <h5 class="text-center p-bold">Buat Akun</h5>
                <p class="p-regular text-center">Cukup dengan menekan tombol login atau daftar serta mengisi data diri, Anda dapat memiliki akun untuk mengerjakan soal simulasi</p>
            </div>
        </div>
    </div>
    <div class="d-flex mb-5">
        <div class="card h-100">
            <div class="card-img d-flex align-items-center justify-content-center">2</div>
            <div class="card-info">
                <h5 class="text-center p-bold">Pilih Tipe</h5>
                <p class="p-regular text-center">Hanya dengan menekan tombol Mulai Ujian di atas atau di Dashboard, Anda dapat memulai ujian!</p>
            </div>
        </div>
    </div>
    <div class="d-flex mb-5">
        <div class="card h-100">
            <div class="card-img d-flex align-items-center justify-content-center">3</div>
            <div class="card-info">
                <h5 class="text-center p-bold">Kerjakan</h5>
                <p class="p-regular text-center">Baca instruksi dan perhatikan sisa waktu ujian. Selamat mengerjakan!</p>
            </div>
        </div>
    </div>
</div>
</div>
<!--Akhir langkah-->
                  
<!--Footer-->
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-4 bg-yellow-normal1">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <span class="mb-0 text-body-secondary">© DEB, Sekolah Vokasi</span>
    </div>
    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">    
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3841b3" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
        </svg></a>
        </li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3841b3" class="bi bi-facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </svg></a>
        </li>
        <li class="ms-3"><a class="text-body-secondary me-4" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3841b3" class="bi bi-instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </svg></a>
        </li>
    </ul>
</footer>
<!-- Akhir Footer -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>          
</body>
</html>