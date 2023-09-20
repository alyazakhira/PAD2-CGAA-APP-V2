<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Instruksi Esai</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        
    </head>
    <body>
        {{-- Modal --}}
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Pemberitahuan</h5>
                </div>
                <div class="modal-body text-center">
                  <p id="body-text">Anda memiliki waktu istirahat selama <br><span class="mb-1 h2-text p-medium" id="countdown2"> 00 : 00</span></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

        <div class="container">

            {{-- Logo --}}
            <nav class="navbar sticky-top top-0 bg-white px-4 pt-4 d-flex justify-content-between">
                <div class="align-items-center d-flex w-75">
                    <div class="d-flex" style="width: 20%; max-height: 70px">
                        <img src="{{ asset('image/logo-ugm-hitam.svg') }}" class="img-fluid"/>
                    </div>
                </div>
                <div>
                    <p class="mb-1 h2-text p-medium" id="countdown">00 : 00</p>
                </div>
            </nav>

            {{-- Title --}}
            <div class="d-flex justify-content-center">
                <div class="d-flex border-bottom border-2 justify-content-center p-2" style="width: 90%">
                    <div class="h2-text p-semi-bold d-flex mt-3 font-blue-dark2">Instruksi Simulasi Esai Tingkat Pusat</div>
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
                                       
                    
            </div>

            {{-- Button --}}
            <div class="d-flex justify-content-center" id="btn_start">
                <div class="row justify-content-center my-4" style="width: 100%">
                    {{-- <div class="row me-3" style="width: 40%">
                        <a href="{{ route('exam.type') }}" type="button" class="btn btn-lg btn-outline-yellow-dark text-decoration-none">Kembali</a>
                    </div> --}}
                    <form action="{{ route('essay.page') }}" method="POST" class="row mb-5" style="width: 40%">
                        @csrf
                        <input type="hidden" value="pusat" name="exam_type">
                        <button type="submit" class="btn btn-lg btn-blue-normal text-decoration-none">Mulai Simulasi Bagian Esai</button>
                    </form>
                </div>
            </div>

        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.modal').modal('show');
            });

            storage = window.sessionStorage;
            if (!storage.getItem('rest_time')) {
                // storage.setItem('rest_time', 500);
                storage.setItem('rest_time', 60);
            }
            var total_seconds = parseInt(storage.getItem('rest_time'));
            var minutes = parseInt(total_seconds / 60 % 60 ),
                second = parseInt(total_seconds % 60);

            function countdown(){
                document.getElementById("countdown").innerHTML = minutes + " : " + second;
                document.getElementById("countdown2").innerHTML = minutes + " : " + second;
                if (total_seconds <= 0) {
                    stop_timer();
                    countdown_stop();
                } else {
                    total_seconds -= 1;
                    hour = parseInt(total_seconds / 3600),
                    second = parseInt(total_seconds % 60),
                    minutes = parseInt(total_seconds / 60 % 60 );
                }
                storage.setItem('rest_time', total_seconds);
            }
            var cd = setInterval(countdown, 1000);

            function stop_timer(){
                clearInterval(cd);
                storage.removeItem("rest_time");
            }

            function countdown_stop(){
                // btn = document.getElementById('btn_start')
                document.getElementById("countdown").classList.add('d-none')
                $('#body-text').text('Waktu istirahat Anda telah usai. Silahkan lanjutkan pengerjaan simulasi!');
                // btn.classList.remove('d-none')
            }

            function preventBack() {
                window.history.forward(); 
            }
            setTimeout("preventBack()", 0);

            window.onunload = function () { null };
        </script>
    </body>
</html>