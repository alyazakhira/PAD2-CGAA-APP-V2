<!DOCTYPE html>
<html lang="en">
<head>
        {{-- Meta and Title --}}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Simulasi CGAA | Daftar</title>

        {{-- Online-based Stylesheet --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        
        {{-- Local-based Stylesheet --}}
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
</head>
<body>
<!-- Wrapper Konten -->
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center"> 
        <div class="col-xl-12">
            <div class="row vh-100">

                <!-- Background Biru -->
                <div class="col-lg-6 d-flex align-items-center bg-blue-normal1">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4"></div>
                </div>

                <!-- Background Kuning -->
                <div class="col-lg-6 p-5 bg-yellow-normal1">

                    <!-- Teks Daftar -->
                    <div class="text-center">
                        <h2 class="h3-text mt-1 mb-4 font-blue-dark1 p-bold">Daftar</h2>
                    </div>

                    <!-- Form Daftar -->
                    @if ($errors->any())
                    <div class="fixed-top" aria-live="assertive" aria-atomic="true" data-bs-delay="100">
                        <div class="toast-container top-0 end-0 p-3">
                            @foreach ($errors->all() as $error)
                            <div class="toast text-bg-danger border-0 show" role="alert">
                                <div class="d-flex">
                                    <div class="toast-body">{{ $error }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <form action="/sign-up" method="POST">
                        @csrf
                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto p-semi-bold font-blue-dark1">
                          <label class="form-label mb-0" for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <!-- Jenis Kelamin -->
                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                            <label class="form-label p-semi-bold mb-0 font-blue-dark1" for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="col-10 ms-1">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                                    <label class="form-check-label" for="female">Perempuan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                    <label class="form-check-label" for="male">Laki-laki</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tanggal Lahir -->
                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto p-semi-bold font-blue-dark1">
                            <label class="form-label mb-0" for="date">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="date" name="date_of_birth" required>                          
                        </div>
                        
                        <!-- Status -->
                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                            <label class="form-label p-semi-bold font-blue-dark1 mb-0">Status</label>
                            <div class="col-10 ms-1">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="occupation_type" id="mahasiswa" value="mahasiswa" required onclick="fungsi_mahasiswa()">
                                    <label class="form-check-label" for="mahasiswa">Mahasiswa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="occupation_type" id="non_mahasiswa" value="non-mahasiswa" required onclick="fungsi_mahasiswa()">
                                    <label class="form-check-label" for="non_mahasiswa">Non Mahasiswa</label>
                                </div>
                            </div>
                        </div>

                        {{-- Institusi --}}
                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                            <label class="form-label mb-0 p-semi-bold font-blue-dark1" for="institution">Institusi/Universitas</label>
                            <input type="text" class="form-control" id="institution" name="institution">
                        </div>

                        <!-- Form Mahasiswa -->
                        <div id="mahasiswa_form" style="display: none;">
                            <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                                <label class="form-label mb-0 p-semi-bold font-blue-dark1" for="study_program">Program Studi</label>
                                <input type="text" class="form-control" id="study_program" name="study_program">
                            </div>
                            <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                                <label class="form-label mb-0 p-semi-bold font-blue-dark1" for="generation">Angkatan</label>
                                <input type="number" class="form-control" id="generation" name="generation">
                            </div>
                        </div>

                        <!-- Non Mahasiswa -->
                        <div id="non_mahasiswa_form" style="display: none;">
                            <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                                <label class="form-label mb-0 p-semi-bold font-blue-dark1" for="occupation">Pekerjaan</label>
                                <input type="text" class="form-control" id="occupation" name="occupation">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                            <label class="form-label mb-0 p-semi-bold font-blue-dark1" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- Password -->
                        <div class="form-outline mb-5 d-grid gap-2 col-10 mx-auto">
                            <label class="form-label mb-0 p-semi-bold font-blue-dark1" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
      
                        <!-- Button Daftar -->
                        <div class="text-center d-grid gap-2 col-10 mx-auto">
                            <button class="btn btn-blue-normal" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>

{{-- The Document-based Script --}}
<script>
    function fungsi_mahasiswa() {
        var checkBox = document.getElementById("mahasiswa");
        var text = document.getElementById("mahasiswa_form");
        var checkBox2 = document.getElementById("non_mahasiswa");
        var text2 = document.getElementById("non_mahasiswa_form");
        if (checkBox.checked == true){
            mahasiswa_form.style.display = "block";
            non_mahasiswa_form.style.display = "none";
        } else {
            non_mahasiswa_form.style.display = "block";
            mahasiswa_form.style.display = "none";
        }
    }


</script>
      
</body>
</html>