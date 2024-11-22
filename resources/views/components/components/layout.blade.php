<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Career Connect</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    @yield('head')
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body class="background">

    @error('company')
        <div class="alert alert-warning alert-dismissible fade show position-fixed bg-danger end-0 bottom-0 mx-2 col-sm-4 text-bg-danger"
            role="alert">
            <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror




    <nav class="navbar navbar-expand-lg navbar-light bg-white mw-100">
        <div class="container">
            <!-- Navbar Brand with Logo and Text -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('public_img/logo.png') }}" alt="Logo" class="me-2 logo">
                <!-- Logo Image -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto fw-bold">
                    <li class="nav-item mx-5">
                        <a class="nav-link" href="{{ route('home') . '/' }}">Home</a>
                    </li>
                    <li class="nav-item mx-5">
                        <a class="nav-link" href="{{ route('listings') }}">Listings</a>
                    </li>
                    <li class="nav-item mx-5">
                        <a class="nav-link" href="{{ route('internships') }}">Internships</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    @guest

                        <a class="nav-link btn-signup border-black border-end" href="{{ route('login') }}">Login</a>
                        <a class="nav-link btn-signup border-start border-black" href="{{ route('sign-up') }}">Signup</a>
                    </div>
                @endguest
                @auth
                    <a href="{{ route('profile') }}" class="nav-link btn-signup border-black border-end">
                        <i class="fa-solid fa-user"></i>

                    </a>
                    <a href="{{ route('notification') }}" class="nav-link btn-signup border-black border-start">
                        <i class="fa-solid fa-bell"></i>
                    </a>

                @endauth
            </div>
        </div>

        </div>
    </nav>


    <main class="mw-100">
        @yield('content')
    </main>


    <div class="bg-success">
        <h3>Developer's Console</h3>
        <div class="">
            @if (session('employer'))
                Employer
                {{ session('employer')->id }}
            @endif
            @if (session('applicant'))
                Applicant
                {{ session('applicant')->id }}
            @endif
            @if (session('company'))
                Company
                {{ session('company')->id }}
            @endif
            @auth
                <p>
                    User:
                    {{ auth()->user() }}</p>
            @endauth
            @guest
                <h2>Currently on guest view.</h2>
            @endguest
        </div>
    </div>


    <div class="bg-secondary">
        <footer class="py-5 bg-secondary">
            <div class="">
                <div class="col-2">
                    <h5>Members</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Don Dominick
                                Enargan</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Rhose An P.
                                Raganit</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Joren Naungayan</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Lowrence Alburo</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Aaron Lanos</a></li>
                    </ul>
                </div>



                <div class="col-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Listings</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Internships</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>

                <div class="col-4 offset-1">
                    <form>
                        <h5>Subscribe to our newsletter!</h5>
                        <p>Monthly digest of whats new and exciting from us.</p>
                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>© CareerConnect 2024, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <!-- X (Twitter) Icon -->
                    <li class="ms-3">
                        <a class="link-dark" href="#" target="_blank">
                            <i class="bi bi-twitter" style="font-size: 24px;"></i>
                        </a>
                    </li>

                    <!-- Instagram Icon -->
                    <li class="ms-3">
                        <a class="link-dark" href="#" target="_blank">
                            <i class="bi bi-instagram" style="font-size: 24px;"></i>
                        </a>
                    </li>

                    <!-- Facebook Icon -->
                    <li class="ms-3">
                        <a class="link-dark" href="#" target="_blank">
                            <i class="bi bi-facebook" style="font-size: 24px;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>


    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>

</html>
