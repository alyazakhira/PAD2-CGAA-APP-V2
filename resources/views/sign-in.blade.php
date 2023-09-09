<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- Meta and Title --}}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Simulasi CGAA | Masuk</title>

        {{-- Online-based Stylesheet --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        
        {{-- Local-based Stylesheet --}}
        <link rel="stylesheet" href={{ asset('style/font.css') }}>
        <link rel="stylesheet" href={{ asset('style/button.css') }}>
        <link rel="stylesheet" href={{ asset('style/color.css') }}>
        <link rel="stylesheet" href={{ asset('style/style.css') }}>
    </head>
    <body>
        <!-- The wrapper -->
        <main class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-12">
                    <div class="row vh-100">

                        <!-- The colored blank space section -->
                        <section class="col-lg-6 bg-yellow-normal1"></section>

                        <!-- The form section -->
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
                        <section class="col-lg-6 p-5 bg-blue-normal1">
                            <div class="text-center">
                                <h2 class="h3-text mt-1 mb-3 pb-1 p-bold font-yellow-light1">Masuk</h2>
                            </div>
                            <form action="/sign-in" method="POST">
                                @csrf
                                <div class="d-flex flex-column justify-content-between" style="height: 75vh">
                                    <div class="d-flex flex-wrap">
                                        <!-- Email input -->
                                        <div class="form-outline mb-4 d-grid gap-2 col-10 mx-auto fw-semibold">
                                            <label class="form-label font-yellow-light1 par-text p-medium mb-0" for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text fw-bold font-blue-dark2 bg-yellow-light2">@</span>
                                                <input name="email" type="email" class="form-control" placeholder="Email" aria-label="Email" required>
                                            </div>
                                        </div>
                                        
                                        <!-- Password input -->
                                        <div class="form-outline mb-2 d-grid gap-2 col-10 mx-auto fw-semibold">
                                            <label class="form-label font-yellow-light1 par-text p-medium mb-0" for="password">Password</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text font-blue-dark2 bg-yellow-light2"><i class="bi bi-lock-fill"></i></span>
                                                <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" required>
                                            </div>
                                        </div>
                                        <div  class="mb-5 d-grid gap-2 col-10 mx-auto">
                                            <a class="forgot-pw par-text p-medium mb-0" href="/input-email">Lupa Password?</a>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex flex-wrap">
                                        <!-- Submit credential button -->
                                        <div class="d-grid col-10 mx-auto">
                                            <button type="submit" class="btn btn-yellow-normal">Masuk</button>
                                        </div>

                                        <!-- "Or" -->
                                        <div class="my-5 col-10 mx-auto" style="color: white">
                                            <div class="d-flex justify-content-center align-items-center position-relative" style="width: 100%">
                                                <div style="height: 2px; width: 100%; background-color: white;"></div>
                                                <p class="position-absolute bg-blue-normal1" style="margin-top: 1rem; padding: 0 11px 1px 11px;">Belum punya akun?</p>
                                            </div>
                                        </div>

                                        <!-- Go to register page -->
                                        <div class="d-grid col-10 mx-auto">
                                            <a href="/sign-up" class="btn btn-yellow-light mb-3" type="button">Daftar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>