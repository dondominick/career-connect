@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
    <style>
        .z-50 {
            z-index: 50;
        }

        /* Add responsive styles */
        @media (max-width: 768px) {

            /* Adjust search bar */
            .searchbar {
                flex-direction: column;
                padding: 10px;
            }

            /* Adjust button */
            .xbtn {
                margin-top: 10px;
                width: 100%;
            }

            /* Stack the filters on small screens */
            .form-select {
                width: 100%;
                margin-top: 10px;
            }

            /* Adjust job listings layout */
            #listing li {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            /* Adjust job listing card layout */
            #listing li .col-lg-6 {
                flex-direction: column;
                align-items: center;
            }

            /* Adjust button size */
            .btn {
                width: 100%;
            }
        }

        /* For smaller devices */
        @media (max-width: 576px) {

            /* Make the search bar full-width */
            .searchbar {
                width: 100%;
            }

            /* Stack the filters */
            .col-md-3,
            #education,
            #arrangement,
            #jobType {
                width: 100%;
            }

            .toggle-container {
                margin: 0;
            }

            .toggle-button {
                font-size: 14px;
            }
        }

        /* Style adjustments for the toggle buttons */
        .toggle-button {
            cursor: pointer;
        }

        .toggle-container {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    {{-- <div class="container">

            {{-- <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $listing->position }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">${{ $listing->salary }}</h6>
                    <p class="card-text">
                        Looking for software engineer
                    </p>
                    <a href="{{ route('view-listing', $listing->id) }}" class="card-link">View Additional Details</a>
                </div>
            </div> --}}
    <!-- Toast Container -->




    <div class="my-5">
        <div class=" mx-auto col-10 col-md-8 col-sm-10">
            <form class="searchbar mx-auto rounded-pill px-3 pt-1 d-flex" action="{{ route('search', 'search') }}"
                method="get">
                @csrf

                <input type="text" class="tbox" placeholder="Search" name="search" id="searchbar">
                <button type="submit" class="xbtn"> <i class="fas fa-search" id="icon"></i>
                </button>
            </form>
        </div>
    </div>

    <form action="{{ route('search', 'value') }}" method="get" hidden id="search-form">
        @csrf
        <input type="text" hidden name="key" id="key-input">
        <input type="text" hidden name="value" id="value-input">
    </form>
    <div class="col-md-3 mx-auto d-flex justify-content-center gap-2">
        <select id="sortFilter" class="form-select rounded"
            style="width: 100%; border: 2px solid #007bff; transition: all 0.3s ease-in-out;" onchange="sortFilter()"
            onmouseover="this.style.borderColor='#0056b3'; this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.5)';"
            onmouseout="this.style.borderColor='#007bff'; this.style.boxShadow='none';"
            onfocus="this.style.borderColor='#80bdff'; this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.8)';"
            onblur="this.style.borderColor='#007bff'; this.style.boxShadow='none';">
            <option value="none" selected disabled>Choose an Option</option>
            <!-- Uncomment options when needed -->
            <!-- <option value="relevance">Relevance</option> -->
            <!-- <option value="salary">Salary</option> -->
            <option value="education">Education</option>
            <option value="arrangement">Work Arrangement</option>
            <!-- <option value="age">Age</option> -->
            <option value="type">Job Type</option>
        </select>


        <select id="jobType" class="form-select" style="display: none" onchange="sortByType()">
            <option selected="none" selected>Choose...</option>

            <option value="full-time">Full Time</option>
            <option value="part-time">Part-Time</option>
            <option value="freelance">Freelance</option>
            <option value="temporary">Temporary</option>
            <option value="contract">Contract</option>
        </select>
        {{-- 
        <div class="input-group" style="display: none" id="salary">
            <input type="number" class="form-control" id="salaryMin" placeholder="Min">
            <span class="input-group-text">-</span>
            <input type="number" class="form-control" id="salaryMax" placeholder="Max">
            <button class="btn button bg-white" onclick="">Enter</button>
        </div>

        <div class="input-group" style="display: none" id="age">
            <input type="number" class="form-control" id="ageMin" placeholder="Min">
            <span class="input-group-text">-</span>
            <input type="number" class="form-control" id="ageMax" placeholder="Max">
            <button class="btn button bg-white" onclick="">Enter</button>

        </div> --}}

        {{-- 
        <select id="relevance" class="form-select" style="display: none" onchange="sortByRelevance()">
            <option value="" selected>Choose...</option>
            <option value="location">By Location</option>
            <option value="skills">By Skills</option>
            <option value="work">By Previous Work Experience</option>
            <option value="education">By Educational Attainment</option>
        </select> --}}

        <select id="education" class="form-select" style="display: none" onchange="sortByEducation()">
            <option selected>Choose...</option>
            <option value="none">None</option>
            <option value="highschool">High School Diploma</option>
            <option value="undergraduate">College Undergraduate</option>
            <option value="bachelor">Bachelor's Degree</option>
            <option value="masters">Master's Degree</option>
            <option value="phd">Ph.D.</option>
        </select>

        <select id="experience" class="form-select" name="" style="display: none" onchange="sortByExperience()">
            <option selected>Choose...</option>
            <option value="entry">Entry Level</option>
            <option value="mid">Mid Level</option>
            <option value="senior">Senior Level</option>
            <option value="director">Director Level</option>
            <option value="executive">Executive</option>
        </select>

        <select name="arrangement" id="arrangement" class="mt-1 form-select" style="display: none"
            onchange="sortByArrangement()">
            <option selected>Choose...</option>
            <option value="onsite">Onsite</option>
            <option value="wfh">Work from Home</option>
            <option value="hybrid">Hybird</option>
        </select>

    </div>




    <div class="mx-auto w-25 text-center">
        <div class="toggle-container my-5 mx-auto">
            <!-- Radio buttons for controlling the slider position -->
            @if (session('red') == '1')
                {{ dd(session('blue')) }}
                {{ dd(session('red')) }}
                <input type="radio" name="toggle" id="toggle-option-0" class="toggle-radio" checked>
                <input type="radio" name="toggle" id="toggle-option-1" class="toggle-radio">
            @endif
            @if (session('blue') == '1')
                <input type="radio" name="toggle" id="toggle-option-1" class="toggle-radio">
                <input type="radio" name="toggle" id="toggle-option-9" class="toggle-radio" checked>
            @endif

        </div>
    </div>

    <div class="mx-auto col-sm-4 text-center">
        <div class="toggle-container my-5 mx-auto w-100">
            <!-- Radio buttons for controlling the slider position -->
            <input type="radio" name="toggle" id="toggle-option-0" class="toggle-radio" checked>
            <input type="radio" name="toggle" id="toggle-option-1" class="toggle-radio">


            <!-- Slider background -->
            <div class="slider"></div>

            <!-- Labels as buttons -->
            <div class="btn-group w-100">
                <label for="toggle-option-0" class="toggle-button" onclick="sortButton('latest')">Latest Job
                    Offers</label>
                <label for="toggle-option-1" class="toggle-button" onclick="sortButton('most')">Top Picked
                    Jobs</label>
            </div>
        </div>
    </div>


    <!-- Job Listings - Latest Job Offers -->
    <div class="w-100">
        <ul class="" id="listing">
            @if ($listings->count() <= 0)
                <div class="w-100 text-center my-5">
                    <h1 class="h1">No Listings Found</h1>

                </div>
            @endif
            @foreach ($listings as $listing)
                <li class="w-100 d-flex flex-wrap gap-4 mx-auto py-5 shadow rounded bg-white border"
                    style="transition: transform 0.2s;">
                    <div
                        class="px-4 col-sm-3 col-12 align-items-center justify-content-center d-flex flex-column text-center bg-light rounded py-3">
                        <h3 class="h2 text-primary fw-bold mb-2">{{ $listing->position }}</h3>
                        <h4 class="text-success">${{ $listing->min_salary }}-${{ $listing->max_salary }}/mo</h4>
                    </div>

                    <div class="col-lg-6 col-md-8 col-12 d-flex flex-row gap-5 px-4">
                        <ul style="list-style-type:none; padding: 0; background-color: transparent;"
                            class="fw-normal fs-5">
                            <li class="text-muted"><i class="bi bi-geo-alt-fill me-2"></i>{{ $listing->location }}</li>
                            <li class="text-muted" style="background-color: transparent;"><i
                                    class="bi bi-building me-2 "></i>{{ $listing->company }}</li>
                            <li class="text-muted"><i class="bi bi-mortarboard-fill me-2"></i>{{ $listing->education }}
                            </li>
                            <li class="text-muted" style="background-color: transparent;"><i
                                    class="bi bi-person-fill me-2"></i>18-45 yrs old</li>
                            <li class="text-muted"><i class="bi bi-briefcase-fill me-2"></i>1 year+ exp</li>
                        </ul>
                        <ul style="list-style-type:none; padding: 0;">
                            <li class="text-muted"><i class="bi bi-clipboard-check-fill me-2"></i>{{ $listing->status }}
                            </li>
                            <li class="text-muted" style="background-color: transparent;"><i
                                    class="bi bi-house-door-fill me-2"></i>{{ $listing->arrangement }}
                            </li>
                            <li class="text-muted"><i class="bi bi-tools me-2"></i>{{ $listing->skills }}</li>
                            <li class="text-muted" style="background-color: transparent;"><i
                                    class="bi bi-clock-fill me-2"></i>{{ $listing->type }}</li>
                        </ul>
                    </div>

                    <div class="col d-flex justify-content-center align-items-center py-3">
                        <button class="btn btn-primary px-5 fs-5 text-light rounded-pill shadow-sm"
                            style="transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#0056b3';"
                            onmouseout="this.style.backgroundColor='#0d6efd';"
                            onclick="window.location.href='{{ route('view-listing', $listing->id) }}'">Apply</button>
                    </div>
                </li>
            @endforeach





        </ul>
    </div>
@endsection
@section('scripts')
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
    <script>
        function sortButton(keys) {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');

            key.val(keys);

            form.submit();
        }

        function sortByEducation() {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');

            const education = $('#education');
            key.val('education');
            value.val(education.val());

            form.submit();
        }

        function sortByType() {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');

            const type = $('#jobType');

            key.val('type');
            value.val(type.val());


            form.submit();

        }

        function sortByArrangement() {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');

            const arrangement = $('#arrangement');

            key.val('arrangement');
            value.val(arrangement.val());

            form.submit();

        }

        // function sortBySalary() {
        //     const form = $('#search-form');
        //     const key = $('#key-input');
        //     const value = $('#value-input');


        //     form.submit();

        // }

        function sortByAge() {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');


            form.submit();

        }

        function sortByExperience() {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');

            const experience = $('#experience');
            key.val('experience');
            value.val(experience.val());

            form.submit();

        }

        function sortByRelevance() {
            const form = $('#search-form');
            const key = $('#key-input');
            const value = $('#value-input');

            const relevance = $('#relevance');

            key.val('relevance');
            value.val(relevance.val());

            form.submit();

        }

        function sortFilter() {
            const sort = $('#sortFilter').val();
            const education = $('#education');
            const type = $('#jobType');
            const arrangement = $('#arrangement');
            const salary = $('#salary');
            const age = $('#age');
            const experience = $('#experience');
            const relevance = $('#relevance');

            switch (sort) {
                case "education":
                    education.show();
                    type.hide();
                    arrangement.hide();
                    salary.hide();
                    age.hide();
                    experience.hide();
                    relevance.hide();
                    break;
                case "type":
                    education.hide();
                    type.show();
                    arrangement.hide();
                    salary.hide();
                    age.hide();
                    experience.hide();
                    relevance.hide();
                    break;
                case "arrangement":
                    education.hide();
                    type.hide();
                    arrangement.show();
                    salary.hide();
                    age.hide();
                    experience.hide();
                    relevance.hide();
                    break;
                case "experience":
                    education.hide();
                    type.hide();
                    arrangement.hide();
                    salary.hide();
                    age.hide();
                    experience.show();
                    relevance.hide();
                    break;
                case "relevance":
                    education.hide();
                    type.hide();
                    arrangement.hide();
                    salary.hide();
                    age.hide();
                    experience.hide();
                    relevance.show();
                    break;
                case "age":
                    education.show();
                    type.hide();
                    arrangement.hide();
                    salary.hide();
                    age.show();
                    experience.hide();
                    relevance.hide();
                    break;
                case "salary":
                    education.hide();
                    type.hide();
                    arrangement.hide();
                    salary.show();
                    age.hide();
                    experience.hide();
                    relevance.hide();
                    break;
                default:
                    education.hide();
                    type.hide();
                    arrangement.hide();
                    salary.hide();
                    age.hide();
                    experience.hide();
                    relevance.hide();
                    break;
            }
        }
    </script>
@endsection
