<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGAA | Sesi 1 </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('style/font.css') }}">
        <link rel="stylesheet" href="{{ asset('style/button.css') }}">
        <link rel="stylesheet" href="{{ asset('style/color.css') }}">
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
        <style>
            .checkbox-btn {
                position: relative;
                padding-left: 30px;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .checkbox-btn input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .checkbox-btn label {
                cursor: pointer;
            }
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 20px;
                width: 20px;
                border: 1px solid #000000;
                border-radius: 5px;
                transition: .2s linear;
            }
            .checkbox-btn input:checked ~ .checkmark {
                background-color: transparent;
            }

            .checkmark:after {
                content: "";
                position: absolute;
                visibility: hidden;
                opacity: 0;
                left: 50%;
                top: 40%;
                width: 10px;
                height: 14px;
                border: 2px solid #0ea021;
                filter: drop-shadow(0px 0px 10px #0ea021);
                border-width: 0 2.5px 2.5px 0;
                transition: .2s linear;
                transform: translate(-50%, -50%) rotate(-90deg) scale(0.2);
            }

            .checkbox-btn input:checked ~ .checkmark:after {
                visibility: visible;
                opacity: 1;
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
                animation: pulse 1s ease-in;
            }

            .checkbox-btn input:checked ~ .checkmark {
                transform: rotate(45deg);
                border: none;
            }

            @keyframes pulse {
                0%,
                100% {
                    transform: translate(-50%, -50%) rotate(0deg) scale(1);
                }
                50% {
                    transform: translate(-50%, -50%) rotate(0deg) scale(1.6);
                }
            }

            .flag{
                clip-path: polygon(100% 75%, 100% 0%, 0% 0%);
                width: 100%;
                height: 100%;
                position: relative;
                bottom: 120%;
                left: 95%;
                border-top-right-radius: 5px;
            }
            tbody, td, tfoot, th, thead, tr{
                padding: 0.3rem;
                border-width: 1px
            }
        </style>
    </head>
    <body>
        <div class="d-flex">
            <form action="{{ route('exam.session1.save') }}" method="POST" id="examForm" class="d-flex w-100" name="examForm">
                @csrf
                <input type="hidden" name="current_page" value="{{ $content->current_page }}" class="visually-hidden">
                {{-- Outside of Sidebar --}}
                <div class="d-flex flex-column justify-content-between w-100 vh-100 p-5 overflow-auto border-0">
                    
                    {{-- Top: Main Content --}}
                    <div class="d-flex flex-column">
                        {{-- Header --}}
                        <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium mb-4">
                            <p class="mb-1 d-none d-lg-block"> Soal No. {{ $content->current_page }}</p>
                            {{-- <p class="mb-1" id="countdown">00 : 00 : 00</p> --}}
                            <button class="navbar-brand btn btn-open d-lg-none" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div>
                        
                        {{-- Question --}}
                        <div class="d-flex flex-column">
                            @foreach ($content->data as $q)
                            <div class="h4-text mb-3">{!! $q->question !!}</div>
                            <div class="d-flex flex-row align-items-start mb-2" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "a")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer1" class="d-none radio-button rounded-2" value="a" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer1" class="d-none radio-button rounded-2" value="a">
                                @endif
                                <label for="answer1" class="me-3 radio-tile">
                                    <span class="d-flex align-items-center justify-content-center p-medium radio-label">A</span>
                                </label>
                                <p>{!! $q->answer_a !!}</p>
                            </div>
                            <div class="d-flex flex-row align-items-start mb-2" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "b")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer2" class="d-none radio-button rounded-2" value="b" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer2" class="d-none radio-button rounded-2" value="b">
                                @endif
                                <label for="answer2" class="me-3 radio-tile rounded-2">
                                    <span class="d-flex btn-blue-light align-items-center justify-content-center p-medium radio-label">B</span>
                                </label>
                                 <p style="color:black">{!! $q->answer_b !!}</p>
                            </div>
                            <div class="d-flex flex-row align-items-start mb-2" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "c")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer3" class="d-none radio-button rounded-2" value="c" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer3" class="d-none radio-button rounded-2" value="c">
                                @endif
                                <label for="answer3" class="me-3 radio-tile">
                                    <span class="d-flex align-items-center justify-content-center p-medium radio-label">C</span>
                                </label>
                                <p style="color:black">{!! $q->answer_c !!}</p>
                            </div>
                            <div class="d-flex flex-row align-items-start mb-2" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "d")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer4" class="d-none radio-button rounded-2" value="d" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer4" class="d-none radio-button rounded-2" value="d">
                                @endif
                                <label for="answer4" class="me-3 radio-tile">
                                    <span class="d-flex bg-blue-light3 align-items-center justify-content-center p-medium radio-label">D</span>
                                </label>
                               <p style="color:black">{!! $q->answer_d !!}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Flag --}}
                    <label class="checkbox-btn align-self-center mt-auto mb-3">
                        <label for="checkbox p-medium">Ragu-ragu</label>
                        <input id="checkbox-{{ $content->current_page }}" type="checkbox" value="{{ $content->current_page }}">
                        <span class="checkmark"></span>
                    </label>
                    
                    {{-- Bottom: Pagination --}}
                    <div class="d-flex justify-content-between align-items-center">
                        @php
                            $prev = ($content->current_page)-1;
                            $next = ($content->current_page)+1;
                        @endphp
                        @if (($content->next_page_url != null) && ($content->prev_page_url == null))
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="#">
                                <button type="button" class="btnPrev">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0" id="page">{{ $content->current_page }}/60</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="{{ route('exam.session1.show', $next) }}">
                                <button class="btnNext" type="submit" value="{{ $next }}" name="save">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                </button>
                            </a>
                        @elseif (($content->next_page_url == null) && ($content->prev_page_url != null))
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="{{ route('exam.session1.show', $prev) }}">
                                <button class="btnPrev" type="submit" value="{{ $prev }}" name="save">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0" id="page">{{ $content->current_page }}/60</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="#">
                                <button type="button" class="btnNext">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                </button>
                            </a>
                        @elseif (($content->next_page_url == null) && ($content->prev_page_url == null))
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="#">
                                <button class="btnPrev">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0" id="page">{{ $content->current_page }}/60</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="#">
                                <button class="btnNext">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                </button>
                            </a>
                        @else
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="{{ route('exam.session1.show', $prev) }}">
                                <button class="btnPrev" type="submit" value="{{ $prev }}" name="save">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0" id="page">{{ $content->current_page }}/60</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="{{ route('exam.session1.show', $next) }}">
                                <button class="btnNext" type="submit" value="{{ $next }}" name="save">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
                
                {{-- The sidebar --}}
                <div class="d-flex flex-column bg-blue-dark1 p-4 vh-100 justify-content-between align-items-center quest-sidebar" style="overflow-y: auto; top: 0;">
                    {{-- Top --}}
                    <div class="d-flex flex-column">
                        {{-- Header --}}
                        <div class="d-flex flex-row justify-content-between justify-content-lg-center align-items-center w-100 mb-5">
                            {{-- Close button --}}
                            <button class="btn btn-close d-flex d-block align-self-start d-lg-none" type="button"></button>
                            {{-- Logo --}}
                            <div class="d-flex align-items-center justify-content-center" style="width: 80%; padding: 5px;">
                                <img src="{{ asset('image/logo-ugm-putih.svg') }}" style="width: 100%"/>
                            </div>
                        </div>

                        {{-- Number --}}
                        <div class="d-grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; width: fit-content; gap: 20px">
                            @for ($i = 1; $i <= ($content->last_page); $i++)
                                @if ($i == $content->current_page)
                                    <button type="submit" name="save" id="{{ $i }}" value="{{ $i }}" class="btn btn-yellow-normal text-center number" style="width: 40px; height: 40px;">
                                        {{ $i }}
                                        <div class="d-none flag bg-red-normal" id="flag-{{ $i }}"></div>
                                    </button>
                                @elseif ($answer->{"answer_$i"} == null)
                                    <button type="submit" name="save" id="{{ $i }}" value="{{ $i }}" class="btn btn-blue-light text-center number" style="width: 40px; height: 40px;">
                                        {{ $i }}
                                        <div class="d-none flag bg-red-normal" id="flag-{{ $i }}"></div>
                                    </button>
                                @else
                                    <button type="submit" name="save" id="{{ $i }}" value="{{ $i }}" class="btn btn-green-normal text-center number" style="width: 40px; height: 40px;">
                                        {{ $i }}
                                        <div class="d-none flag bg-red-normal" id="flag-{{ $i }}"></div>
                                    </button>
                                @endif
                                
                            @endfor
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="row my-4" style="width: 70%">
                        <button type="submit" name="submit" id="submit" value="finished" class="btn btn-yellow-normal">Selesaikan Sesi</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <script type="text/javascript">
            storage = window.sessionStorage;
            if (!storage.getItem('time')) {
                storage.setItem('time', 7200);
                // storage.setItem('time', 120);
            }
            var total_seconds = parseInt(storage.getItem('time'));
            var hour = parseInt(total_seconds / 3600),
                minutes = parseInt(total_seconds / 60 % 60 ),
                second = parseInt(total_seconds % 60);

            function countdown(){
                document.getElementById("countdown").innerHTML = hour + " : " + minutes + " : " + second;
                if (total_seconds <= 0) {
                    stop_timer();
                    document.getElementById("submit").click();
                } else {
                    total_seconds -= 1;
                    hour = parseInt(total_seconds / 3600),
                    second = parseInt(total_seconds % 60),
                    minutes = parseInt(total_seconds / 60 % 60 );
                }
                storage.setItem('time', total_seconds);
            }
            var cd = setInterval(countdown, 1000);

            function stop_timer(){
                clearInterval(cd);
                storage.removeItem("time");
            }

            function preventBack() {
                window.history.forward(); 
            }
            setTimeout("preventBack()", 0);

            window.onunload = function () { null };
        </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            // number on pagination
            var num_page = $('#page').text().split('/')[0];
            console.log(num_page);
            // number on sidebar
            var num_sidebar = document.getElementById(num_page).value;
            // to store number from storage
            var from_session;
            // initialize storage
            const storage = window.sessionStorage;
            // check if the storage null
            if (!storage.getItem('num_flagged')) {
                storage.setItem('num_flagged', 0);
            }
            // function to flag the number
            function flag(number) {
                $("#checkbox-"+number).prop( "checked", true );
                $("#flag-"+number).removeClass("d-none");
            }
            // function to unflag the number
            function unflagged(number) {
                $('#checkbox-'+number).prop( "checked", false );
                $("#flag-"+number).addClass("d-none");
            }
            // get data from storage
            var from_session = storage.getItem('num_flagged').split(',');
            // flag the number from storage
            from_session.forEach(e => {
                flag(e);
            });
            // to click the checklist to flag or unflag
            $('#checkbox-'+num_sidebar).click(function(){
                if (from_session.includes(num_sidebar)) {
                    // if the number flagged, when click its unflagged
                    unflagged(num_sidebar);
                    // remove data from storage
                    var index = from_session.indexOf(num_page);
                    if (index !== -1) {
                        from_session.splice(index, 1);
                    }
                    storage.setItem('num_flagged', from_session);
                }else{
                    // if the number unflagged, when click its flagged
                    flag(num_sidebar);
                    // add data to storage
                    from_session.push(num_sidebar);
                    storage.setItem('num_flagged', from_session);
                }
            });
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