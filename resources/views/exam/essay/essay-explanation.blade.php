<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Simulasi CGGA | Penjelasan Esai </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css"> --}}
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    </head>
    <body>
        <div class="d-flex">
            {{-- @foreach ($content->data as $q) --}}
                {{-- Outside of Sidebar --}}
                <div class="d-flex flex-column justify-content-between w-100 vh-100 p-5 overflow-auto border-0">
                    
                    {{-- Top: Main Content --}}
                    <div class="d-flex flex-column">
                        {{-- Header --}}
                        <div class="d-flex border-bottom border-dark justify-content-between h3-text p-medium mb-4">
                            {{-- <p class="mb-1 d-none d-lg-block"> Soal No. {{ $content->current_page }}</p> --}}
                            <p class="mb-1 d-none d-lg-block"> Soal No. 1</p>
                            <button class="navbar-brand btn btn-open d-lg-none" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div>
                        
                        {{-- Question --}}
                        <div class="d-flex flex-column">
                            <div class="h4-text mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt libero arcu, sit amet dapibus 
                                urna sollicitudin non. Donec pellentesque purus a enim semper condimentum. Duis ac purus velit. 
                                Pellentesque eleifend lobortis laoreet. Morbi nec dolor odio. Nullam eget nisl sem. Mauris lacinia 
                                ante sed tincidunt egestas. Aliquam pulvinar tristique arcu id condimentum. Vivamus porta libero eu 
                                elit faucibus, a ullamcorper est hendrerit. Vestibulum vitae est sem.
                            </div>
                            {{-- <div class="h4-text mb-4">{!! $q->question !!}</div> --}}
                            
                            <div class="border border-dark p-2 mb-4">
                                <p class="h4-text p-semi-bold mb-1">Jawaban </p>
                                <div class="par-text">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt libero arcu, sit amet dapibus 
                                    urna sollicitudin non. Donec pellentesque purus a enim semper condimentum. Duis ac purus velit. 
                                    Pellentesque eleifend lobortis laoreet. Morbi nec dolor odio. Nullam eget nisl sem. Mauris lacinia 
                                    ante sed tincidunt egestas. Aliquam pulvinar tristique arcu id condimentum. Vivamus porta libero eu 
                                    elit faucibus, a ullamcorper est hendrerit. Vestibulum vitae est sem.
                                </div>
                            </div>

                            
                            <div class="border border-dark mb-4 p-2">
                                <p class="h4-text p-semi-bold mb-2">Penjelasan Soal </p>
                                <p class="mb-1"><u>Kunci Jawaban : </u> </p>
                                <div class="par-text">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt libero arcu, sit amet dapibus 
                                    urna sollicitudin non. Donec pellentesque purus a enim semper condimentum. Duis ac purus velit. 
                                    Pellentesque eleifend lobortis laoreet. Morbi nec dolor odio. Nullam eget nisl sem. Mauris lacinia 
                                    ante sed tincidunt egestas. Aliquam pulvinar tristique arcu id condimentum. Vivamus porta libero eu 
                                    elit faucibus, a ullamcorper est hendrerit. Vestibulum vitae est sem.
                                </div>
                            </div>

                            {{-- <form action='#' method="POST" >
                                <textarea id="user_essay_answer" name="user_essay_answer"></textarea>
                                <button class="mt-4 mb-4 w-100 btn btn-blue-normal" type="submit" name="submit">Simpan Jawaban</button>
                            </form> --}}
                        </div>                        
                    </div>
                    
                    {{-- Bottom: Pagination --}}
                    <div class="d-flex justify-content-between align-items-center">
                        {{-- @php
                            $prev = ($content->current_page)-1;
                            $next = ($content->current_page)+1;
                        @endphp --}}
                        {{-- @if (($content->next_page_url != null) && ($content->prev_page_url == null)) --}}
                            {{-- Prev --}}
                            <a type="button" class="btnPrev text-decoration-none" href="#">
                                <div class="signPrev" style="text-decoration: none"><</div>
                                <div class="textPrev">Soal Sebelumnya</div>
                            </a>

                            {{-- Page indicator --}}
                            <div class="d-flex justify-content-center">
                                <p class="h4-text p-medium my-0">1/5</p>
                                {{-- <p class="h4-text p-medium my-0">{{ $content->current_page }}/30</p> --}}
                            </div>

                            {{-- Next --}}
                            <a type="button" class="text-decoration-none btnNext" href="#">
                            {{-- <a type="button" class="text-decoration-none btnNext" href="{{route('exam.explanation', ['page' => $next,'session_id' => $answer->id ])}}"> --}}
                                <div class="text">Soal selanjutnya</div>
                                <div class="sign">></div>
                            </a>
                       
                        {{-- @endif --}}
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
                            @for ($i = 1; $i < 6; $i++)
                            <a href="#" type="button" class="btn btn-blue-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                            @endfor
                            {{-- @for ($i = 1; $i < ($content->last_page)+1; $i++)
                                @if ($answer->{"answer_$i"} != null)
                                    @if ($answer->{"answer_$i"} == $correct_answer->{"c_answer_$i"})
                                        <a href="{{route('exam.explanation', ['page' => $i,'session_id' => $answer->id ])}}" type="button" class="btn btn-blue-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                                    @else
                                        <a href="{{route('exam.explanation', ['page' => $i,'session_id' => $answer->id ])}}" type="button" class="btn btn-red-normal text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                                    @endif
                                @else
                                    <a href="{{route('exam.explanation', ['page' => $i,'session_id' => $answer->id ])}}" type="button" class="btn btn-blue-light text-center" style="width: 40px; height: 40px;">{{ $i }}</a>
                                @endif
                            @endfor --}}
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="row my-4" style="width: 70%">
                        <button type="submit" name="submit" id="submit" value="finished" class="btn btn-yellow-normal">Selesai</button>
                    </div>
                </div>
            {{-- @endforeach --}}
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
        {{-- <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('user_essay_answer',{});
        </script> --}}
    </body>
</html>