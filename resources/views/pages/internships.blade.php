@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endsection
@section('content')
    {{-- <div class="flex justify-content-center">
        <div class="mb-3 container-sm border-2 rounded-sm">
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" />
        </div>

    </div>

    <div class="container">
        @foreach ($internships as $internship)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Intern</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">$10000</h6>
                    <p class="card-text">
                        Looking for interns
                    </p>
                    <a href="{{ route('view-internship', $internship->id) }}" class="card-link">View Additional Details</a>
                </div>
            </div>
        @endforeach

    </div> --}}
    <!-- Add Font Awesome CDN -->


    <!-- Add your styles here -->
    <style>
        .searchbar {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            border-radius: 25px;
            border: 2px solid transparent;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .searchbar:hover {
            border-color: white;
            box-shadow: 0 0 5px 2px white;
        }

        .tbox {
            flex-grow: .5;
            border: none;
            outline: none;
            padding: 8px;
            background-color: transparent;
            color: #333;
            text-align: left;
            /* Center the text */
        }

        .tbox::placeholder {
            color: #aaa;
            text-align: left;
            /* Center the placeholder text */
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
            padding-left: 10px;
            color: #333;
        }
    </style>



    <div class="my-5">
        <div class=" mx-auto col-10 col-md-8 col-sm-10">
            <form class="searchbar mx-auto rounded-pill px-3 pt-1 d-flex" action="{{ route('searchInternships', 'search') }}"
                method="get">
                @csrf

                <input type="text" class="tbox" placeholder="Search" name="search" id="searchbar">
                <button type="submit" class="xbtn"> <i class="fas fa-search" id="icon"></i>
                </button>
            </form>
        </div>
    </div>





    <div class="mx-auto w-25 text-center">
        <div class="toggle-container my-5 mx-auto">
            <!-- Radio buttons for controlling the slider position -->
            <input type="radio" name="toggle" id="toggle-option-0" class="toggle-radio" checked>
            <input type="radio" name="toggle" id="toggle-option-1" class="toggle-radio">

            <!-- Slider background -->
            <div class="slider"></div>

            <!-- Labels as buttons -->
            <div class="btn-group w-100">
                <label for="toggle-option-0" class="toggle-button">Latest Job Offers</label>
                <label for="toggle-option-1" class="toggle-button">Top Picked Jobs</label>
            </div>
        </div>
    </div>

    <!-- Job Listings - Latest Job Offers -->
    <div class="w-100 border">
        <ul class="" id="listing">

            @foreach ($listings as $listing)
                <li class="w-100 d-flex gap-3 mx-auto py-4">
                    <div
                        class="px-3 col-sm-3 col-4 align-items-center justify-content-center d-flex flex-column text-center ">
                        <h3 class="h2 ">Intern</h3>
                        <h4 class="">${{ $listing->salary }}/mo</h4>
                    </div>

                    <div class="col-lg-6">
                        <ul style="list-style-type:none;" class="fw-normal fs-5 bg-transparent">
                            <li class="bg-transparent">{{ $listing->location }}</li>
                            <li class="bg-transparent"> {{ $listing->company }}</li>
                            <li class="bg-transparent"> {{ $listing->education }}</li>
                            <li class="bg-transparent"> 18-45 yrs old</li>
                            <li class="bg-transparent"> 1 year+ exp</li>
                        </ul>
                        <button class="jobbtn text-light d-sm-none">Search</button>

                    </div>

                    <div class="col d-flex justify-content-center align-items-center">
                        <button class="btn bg-primary px-4 fs-5 text-light"
                            onclick="window.location.href='{{ route('view-internship', $listing->id) }}'">Search</button>
                    </div>
                </li>
            @endforeach



        </ul>
    </div>


    <script>
        const searchInput = document.getElementById('searchInput');
        const iconBtn = document.getElementById('iconBtn');
        const icon = document.getElementById('icon');

        searchInput.addEventListener('input', function() {
            if (this.value) {
                icon.classList.replace('fa-search', 'fa-times');
            } else {
                icon.classList.replace('fa-times', 'fa-search');
            }
        });

        // Clear input when "X" is clicked
        iconBtn.addEventListener('click', function() {
            if (icon.classList.contains('fa-times')) {
                searchInput.value = '';
                icon.classList.replace('fa-times', 'fa-search');
                searchInput.focus();
            }
        });
    </script>
@endsection
