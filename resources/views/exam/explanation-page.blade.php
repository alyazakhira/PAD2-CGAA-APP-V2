<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Review Simulasi </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    </head>
    <body>
        <div class="d-flex">
            @foreach ($content->data as $q)
                {{-- Outside of Sidebar --}}
                <div class="d-flex flex-column justify-content-between w-100 vh-100 p-5 overflow-auto border-0">
                    
                    {{-- Top: Main Content --}}
                    <div class="d-flex flex-column">
                        {{-- Header --}}
                        <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium mb-4">
                            <p class="mb-1 d-none d-lg-block"> Soal No. {{ $content->current_page }}</p>
                            <p class="mb-1">Review Soal</p>
                            <button class="navbar-brand btn btn-open d-lg-none" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div>
                        
                        {{-- Question --}}
                        <div class="d-flex flex-column">
                            <div class="h4-text mb-4">{!! $q->question !!}</div>

                            {{-- Choice A --}}
                            @if ($answer->{"answer_$content->current_page"} == "a" && $q->correct_answer != "a")
                                <div class="d-flex flex-row align-items-start rounded-2" style="text-decoration: none; border-radius: 25px;">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-red-normal p-medium rounded-2" style="width: 35px; height: 35px; padding: 1rem; color: white; border-radius: 25px;">A</div>
                                    <p>{!! $q->answer_a !!}</p>
                                </div>
                            @elseif ($answer->{"answer_$content->current_page"} != "a" && $q->correct_answer != "a")
                                <div class="d-flex flex-row align-items-start rounded-2" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-light2 p-medium rounded-2" style="width: 35px; height: 35px; padding: 1rem;">A</div>
                                    <p>{!! $q->answer_a !!}</p>
                                </div>
                            @else
                                <div class="d-flex flex-row align-items-start rounded-2" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-dark1 p-medium rounded-2" style="width: 35px; height: 35px; padding: 1rem; color: white">A</div>
                                    <p>{!! $q->answer_a !!}</p>
                                </div>
                            @endif

                            {{-- Choice B --}}
                            @if ($answer->{"answer_$content->current_page"} == "b" && $q->correct_answer != "b")
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-red-normal p-medium" style="width: 35px; height: 35px; padding: 1rem; color: white">B</div>
                                    <p>{!! $q->answer_b !!}</p>
                                </div>
                            @elseif ($answer->{"answer_$content->current_page"} != "b" && $q->correct_answer != "b")
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-light2 p-medium" style="width: 35px; height: 35px; padding: 1rem;">B</div>
                                    <p>{!! $q->answer_b !!}</p>
                                </div>
                            @else
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-dark1 p-medium" style="width: 35px; height: 35px; padding: 1rem; color: white">B</div>
                                    <p>{!! $q->answer_b !!}</p>
                                </div>
                            @endif

                            {{-- Choice C --}}
                            @if ($answer->{"answer_$content->current_page"} == "c" && $q->correct_answer != "c")
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-red-normal p-medium" style="width: 35px; height: 35px; padding: 1rem; color: white">C</div>
                                    <p>{!! $q->answer_c !!}</p>
                                </div>
                            @elseif ($answer->{"answer_$content->current_page"} != "c" && $q->correct_answer != "c")
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-light2 p-medium" style="width: 35px; height: 35px; padding: 1rem;">C</div>
                                    <p>{!! $q->answer_c !!}</p>
                                </div>
                            @else
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-dark1 p-medium" style="width: 35px; height: 35px; padding: 1rem; color: white">C</div>
                                    <p>{!! $q->answer_c !!}</p>
                                </div>
                            @endif

                            {{-- Choice D --}}
                            @if ($answer->{"answer_$content->current_page"} == "d" && $q->correct_answer != "d")
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-red-normal p-medium" style="width: 35px; height: 35px; padding: 1rem; color: white">D</div>
                                    <p>{!! $q->answer_d !!}</p>
                                </div>
                            @elseif ($answer->{"answer_$content->current_page"} != "d" && $q->correct_answer != "d")
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-light2 p-medium" style="width: 35px; height: 35px; padding: 1rem;">D</div>
                                    <p>{!! $q->answer_d !!}</p>
                                </div>
                            @else
                                <div class="d-flex flex-row align-items-start" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center me-3 bg-blue-dark1 p-medium" style="width: 35px; height: 35px; padding: 1rem; color: white">D</div>
                                    <p>{!! $q->answer_d !!}</p>
                                </div>
                            @endif
                        </div>                        
                    </div>

                    {{-- Middle: Explanation --}}
                    <div class="d-flex flex-column border border-black rounded-1 p-3 my-3">
                        <p class="h4-text p-semi-bold">Penjelasan Soal</p>
                        <div class="d-flex flex-column mb-2">{!! $q->question_explanation !!}</div>
                        <p class="p-medium m-0">Jawaban benar: {{ $q->correct_answer }}</p>
                    </div>
                    
                    {{-- Bottom: Pagination --}}
                    <div class="d-flex justify-content-between align-items-center">
                        @php
                            $prev = ($content->current_page)-1;
                            $next = ($content->current_page)+1;
                        @endphp
                        @if (($content->next_page_url != null) && ($content->prev_page_url == null))
                            {{-- Prev --}}
                            <a type="button" class="btnPrev text-decoration-none" href="#">
                                <div class="signPrev" style="text-decoration: none"><</div>
                                <div class="textPrev">Soal Sebelumnya</div>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a type="button" class="text-decoration-none btnNext" href="{{route('exam.explanation', ['page' => $next,'session_id' => $answer->id ])}}">
                                <div class="text">Soal selanjutnya</div>
                                <div class="sign">></div>
                            </a>
                        @elseif (($content->next_page_url == null) && ($content->prev_page_url != null))
                            {{-- Prev --}}
                            <a type="button" class="btnPrev text-decoration-none" href="{{route('exam.explanation', ['page' => $prev,'session_id' => $answer->id ])}}">
                                <div class="signPrev" style="text-decoration: none"><</div>
                                <div class="textPrev">Soal Sebelumnya</div>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="btnNext text-decoration-none" href="#">
                                <div class="text">Soal selanjutnya</div>
                                <div class="sign">></div>
                            </a>
                        @elseif (($content->next_page_url == null) && ($content->prev_page_url == null))
                            {{-- Prev --}}
                            <a class="btnPrev text-decoration-none" href="#">
                                <div class="signPrev"><</div>
                                <div class="textPrev">Soal Sebelumnya</div>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="btnNext text-decoration-none" href="#">
                                <div class="text">Soal selanjutnya</div>
                                <div class="sign">></div>
                            </a>
                        @else
                            {{-- Prev --}}
                            <a class="btnPrev text-decoration-none" href="{{route('exam.explanation', ['page' => $prev,'session_id' => $answer->id ])}}">   
                                <div class="signPrev"><</div>
                                <div class="textPrev">Soal Sebelumnya</div>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p>
                            </div>

                            {{-- Next --}}
                            <a class="btnNext text-decoration-none" href="{{route('exam.explanation', ['page' => $next,'session_id' => $answer->id ])}}">
                                <div class="text">Soal selanjutnya</div>
                                <div class="sign">></div>
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
                            <div class="d-flex align-items-center justify-content-center " style="width: 70%; padding: 5px;"><img src = "{{ asset('image/logoVokasi.svg') }}"/></div>
                        </div>

                        {{-- Number --}}
                        <div class="d-grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; width: fit-content; gap: 20px">
                            @for ($i = 1; $i < ($content->last_page)+1; $i++)
                                @if ($answer->{"answer_$i"} != null)
                                    @if ($answer->{"answer_$i"} == $correct_answer->{"c_answer_$i"})
                                        <a href="{{route('exam.explanation', ['page' => $i,'session_id' => $answer->id ])}}" type="button" class="btn btn-green-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                                    @else
                                        <a href="{{route('exam.explanation', ['page' => $i,'session_id' => $answer->id ])}}" type="button" class="btn btn-red-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                                    @endif
                                @else
                                    <a href="{{route('exam.explanation', ['page' => $i,'session_id' => $answer->id ])}}" type="button" class="btn btn-blue-light text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                                @endif
                            @endfor
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="row my-4" style="width: 70%">
                        <a href="{{ route('user.dashboard') }}" type="button" class="btn btn-yellow-normal">Dashboard</a>
                    </div>
                </div>
            @endforeach
        </div>
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