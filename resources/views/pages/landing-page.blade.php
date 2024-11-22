@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <div class="banner-custom" style="background-image: url({{ asset('public_img/background.png') }});">
        <div class="container">
            <div class="text-section">
                <h1>Search, Apply, <br>Succeed.</h1>
                <p>Welcome to CareerConnect, your gateway <br>to seamless online job opportunities.</p>

                <br>
                <div class="search-container">
                    <div class="input-group">
                        <label for="job" class="label">What?</label>
                        <input type="text" id="job" placeholder="Enter Job Title or Keywords"
                            class="input-field left-field">
                    </div>

                    <div class="input-group">
                        <label for="location" class="label">Where?</label>
                        <input type="text" id="location" placeholder="Enter city, or region"
                            class="input-field right-field">
                    </div>

                    <button class="search-button">SEARCH</button>
                </div>

                <br>
                <div class="popular-searches">
                    <span>Popular Searches</span>
                    <button>🔍 IT & Tech Jobs</button>
                    <button>🔍 Healthcare Jobs</button>
                    <button>🔍 Virtual Assistant</button>
                </div>

            </div>
        </div>
    </div>
@endsection
