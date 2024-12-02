@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <section class="hero align-items-center d-flex"
        style="background-image: url('{{ asset('public_img/background.png') }}')">
        <div class="container">
            <div class="text-section">
                <h1>Search, Apply, <br>Succeed.</h1>
                <p>Welcome to CareerConnect, your gateway <br>to seamless online job opportunities.</p>

                <br>
                <div class="search-container">
                    <form class="input-wrapper" action="{{ route('search', 'search') }}" class="input-group" method="get"
                        id="job-form">
                        <div class="input-group">
                            @csrf

                            <!-- PARA MUGANA ANG SEARCH BARS BAI BUTNGAN ATA NI SYA UG FORM PARA MAKASEARCH I THINK?? -->
                            <label for="job">What?</label>
                            <input type="text" id="job" placeholder="Enter Job Title or Keywords" name="job"
                                class="input-field">
                        </div>

                        <div class="input-group">
                            <label for="location">Where?</label>
                            <input type="text" id="location" placeholder="Enter city, or region" class="input-field"
                                name="location">
                        </div>
                    </form>

                    <button
                        onclick="document.getElementById('job-form').submit().onsubmit(function () {
                            document.getElementById('location-form').submit()
                        });"
                        class="search-button">SEARCH</button>
                </div>

                <br>
                <div class="popular-searches">
                    <h6>Popular Searches</h6>
                    <div class="search-buttons">
                        <button><i class="fa-solid fa-magnifying-glass"></i> IT & Tech Jobs</button>
                        <button><i class="fa-solid fa-magnifying-glass"></i> Healthcare Jobs</button>
                        <button><i class="fa-solid fa-magnifying-glass"></i> Virtual Assistant</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
