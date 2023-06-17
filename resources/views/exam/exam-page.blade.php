<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Simulasi </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
        <link rel="stylesheet" href={{ asset('style/style.css') }}>
    </head>
    <body>
        <div class="d-flex">
            <form action="{{ route('exam.saveorsubmit') }}" method="POST" class="d-flex w-100">
                @csrf
                <input type="hidden" name="current_page" value="{{ $content->current_page }}" class="visually-hidden">
                {{-- Outside of Sidebar --}}
                <div class="d-flex flex-column justify-content-between w-100 vh-100 p-5 overflow-auto border-0">
                    
                    {{-- Top: Main Content --}}
                    <div class="d-flex flex-column">
                        {{-- Header --}}
                        <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium mb-4">
                            {{-- <p class="mb-1 d-none d-lg-block"> Soal No. 29</p> --}}
                            <p class="mb-1 d-none d-lg-block"> Soal No. {{ $content->current_page }}</p>
                            <p class="mb-1" id="countdown">00 : 00 : 00</p>
                            <button class="navbar-brand btn btn-open d-lg-none" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div>
                        
                        {{-- Question --}}
                        <div class="d-flex flex-column">
                            @foreach ($content->data as $q)
                            <div class="h4-text mb-4">{!! $q->question !!}</div>
                            <div class="d-flex flex-row align-items-start" style="text-decoration: none" href="#">
                                @if ($answer->{"answer_$content->current_page"} == "a")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer1" class="d-none radio-button" value="a" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer1" class="d-none radio-button" value="a">
                                @endif
                                <label for="answer1" class="me-3 radio-tile">
                                    <span class="d-flex align-items-center justify-content-center p-medium radio-label">A</span>
                                </label>
                                <p>{{ $q->answer_a }}</p>
                            </div>
                            <div class="d-flex flex-row align-items-start" href="#" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "b")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer2" class="d-none radio-button" value="b" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer2" class="d-none radio-button" value="b">
                                @endif
                                <label for="answer2" class="me-3 radio-tile">
                                    <span class="d-flex btn-blue-light align-items-center justify-content-center p-medium radio-label">B</span>
                                </label>
                                 <p style="color:black">{{ $q->answer_b }}</p>
                            </div>
                            <div href="#" class="d-flex flex-row align-items-start" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "c")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer3" class="d-none radio-button" value="c" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer3" class="d-none radio-button" value="c">
                                @endif
                                <label for="answer3" class="me-3 radio-tile">
                                    <span class="d-flex align-items-center justify-content-center p-medium radio-label">C</span>
                                </label>
                                <p style="color:black">{{ $q->answer_c }}</p>
                            </div>
                            <div class="d-flex flex-row align-items-start" href="#" style="text-decoration: none">
                                @if ($answer->{"answer_$content->current_page"} == "d")
                                    <input type="radio" name="{{ $content->current_page }}" id="answer4" class="d-none radio-button" value="d" checked>
                                @else
                                    <input type="radio" name="{{ $content->current_page }}" id="answer4" class="d-none radio-button" value="d">
                                @endif
                                <label for="answer4" class="me-3 radio-tile">
                                    <span class="d-flex bg-blue-light3 align-items-center justify-content-center p-medium radio-label">D</span>
                                </label>
                               <p style="color:black">{{ $q->answer_d }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- Bottom: Pagination --}}
                    <div class="d-flex justify-content-between align-items-center">
                        @php
                            $prev = ($content->current_page)-1;
                            $next = ($content->current_page)+1;
                        @endphp
                        @if (($content->next_page_url != null) && ($content->prev_page_url == null))
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="#">
                                <button class="btnPrev">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="{{ route('exam.progress', $next) }}">
                                <button class="btnNext" type="submit" value="{{ $next }}" name="save">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>
                        @elseif (($content->next_page_url == null) && ($content->prev_page_url != null))
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="{{ route('exam.progress', $prev) }}">
                                <button class="btnPrev" type="submit" value="{{ $prev }}" name="save">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="#">
                                <button class="btnNext">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>
                        @elseif (($content->next_page_url == null) && ($content->prev_page_url == null))
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="#">
                                <button class="btnPrev">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="#">
                                <button class="btnNext">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>
                        @else
                            {{-- Prev --}}
                            <a class="text-decoration-none" href="{{ route('exam.progress', $prev) }}">
                                <button class="btnPrev" type="submit" value="{{ $prev }}" name="save">    
                                    <div class="signPrev" style="text-decoration: none"><</div>
                                    <div class="textPrev">Soal Sebelumnya</div>
                                    <button type="submit" class="visually-hidden"></button>
                                </button>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="text-decoration-none" href="{{ route('exam.progress', $next) }}">
                                <button class="btnNext" type="submit" value="{{ $next }}" name="save">
                                    <div class="text">Soal selanjutnya</div>
                                    <div class="sign">></div>
                                    <button type="submit" class="visually-hidden"></button>
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
                            <div class="d-flex align-items-center justify-content-center bg-yellow-normal1" style="width: 70%; padding: 5px;">Ini logo</div>
                        </div>

                        {{-- Number --}}
                        <div class="d-grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; width: fit-content; gap: 20px">
                            @for ($i = 1; $i < ($content->last_page)+1; $i++)
                                @if ($i == $content->current_page)
                                    <button type="submit" name="save" value="{{ $i }}" class="btn btn-yellow-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</button>
                                @elseif ($answer->{"answer_$i"} == null)
                                    <button type="submit" name="save" value="{{ $i }}" class="btn btn-blue-light text-center" style="width: 40px; height: 40px;">{{ $i }}</button>
                                @else
                                    <button type="submit" name="save" value="{{ $i }}" class="btn btn-blue-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</button>
                                @endif
                                
                            @endfor
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="row my-4" style="width: 70%">
                        <button type="submit" name="submit" value="finished" class="btn btn-yellow-normal">Selesai</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <script type="text/javascript">
            storage = window.sessionStorage;
            if (!storage.getItem('time')) {
                // storage.setItem('time', 7200);
                storage.setItem('time', 10);
            }

            var total_seconds = parseInt(storage.getItem('time'));
            // var c_hour = parseInt(total_seconds / 3600),
            //     c_minutes = parseInt(total_seconds / 60 % 60 ),
            //     c_second = parseInt(total_seconds % 60);

            function countdown(){
                document.getElementById("countdown").innerHTML = total_seconds;
                // $("#countdown").html(total_seconds);
                // $("#countdown").html(c_hour + " : " + c_minutes + " : " + c_second);
                if (total_seconds <= 0) {
                    var url = "/r";
                    location.href = url;
                }else{
                    total_seconds -= 1;
                    // c_hour = parseInt(total_seconds / 3600),
                    // c_second = parseInt(total_seconds % 60),
                    // c_minutes = parseInt(total_seconds / 60 % 60 );
                }
                storage.setItem('time', total_seconds);
            }
            setInterval(countdown, 1000);

            function preventBack() {
                window.history.forward(); 
            }
            setTimeout("preventBack()", 0);

            window.onunload = function () { null };
        </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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