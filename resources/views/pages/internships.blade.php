@extends('components.components.layout')
@section('head')
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

    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endsection
@section('content')
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

    <form action="{{ route('searchInternships', 'value') }}" method="get" hidden id="search-form">
        @csrf
        <input type="text" hidden name="key" id="key-input">
        <input type="text" hidden name="value" id="value-input">
    </form>

    <div class="col-md-4 mx-auto d-flex gap-3">
        <!-- Main Filter Dropdown -->
        <select id="sortFilter" class="form-select" style="width: 100%;" onchange="sortFilter()">
            <option value="none" selected>Choose...</option>
            <option value="">By Salary</option>
            <option value="arrangement">Work Arrangement</option>
        </select>


        <!-- Education Filter -->
        <select id="education" name="education" class="form-select" style="width: 100%; display: none;"
            onchange="sortByEducation()">
            <option selected>Choose...</option>
            <option value="none">None</option>
            <option value="highschool">High School Diploma</option>
            <option value="undergraduate">College Undergraduate</option>
            <option value="bachelor">Bachelor's Degree</option>
            <option value="masters">Master's Degree</option>
            <option value="phd">Ph.D.</option>
        </select>

        <!-- Salary Filter -->

        <select id="salary" class="form-select" name="salary" style="width: 100%; display: none;"
            onchange="sortByEducation()">
            <option selected="">Choose...</option>
            <option value="paid">Paid Internships</option>
            <option value="unpaid">Unpaid Internships</option>
        </select>

        <!-- Work Arrangement Filter -->
        <select name="arrangement" id="arrangement" class="form-select" style="width: 100%; display: none;"
            onchange="sortByArrangement()">
            <option selected="none">Choose...</option>
            <option value="onsite">Onsite</option>
            <option value="wfh">Work from Home</option>
            <option value="hybrid">Hybrid</option>
        </select>

        {{-- By Internship Duration --}}

        <select name="duration" id="duration" class="form-select" style="width: 100%; display: none;"
            onchange="sortByArrangement()">
            <option selected="">Choose...</option>
            <option value="1>">Less than 1 month</option>
            <option value="1-2">1 - 2 Months</option>
            <option value="2<">More than 2 Months</option>
        </select>



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
                <label for="toggle-option-0" class="toggle-button">Latest Internships Offers</label>
                <label for="toggle-option-1" class="toggle-button">Top Picked Internships</label>
            </div>
        </div>
    </div>


    <!-- Job Listings - Latest Job Offers -->
    <div class="w-100">
        <ul class="" id="listing">

            @foreach ($listings as $listing)
                <li class="w-100 d-flex gap-3 mx-auto py-4">
                    <div
                        class="px-3 col-sm-3 col-4 align-items-center justify-content-center d-flex flex-column text-center ">
                        <h3 class="h2 ">Intern</h3>
                        <h4 class="">${{ $listing->min_salary }}-${{ $listing->max_salary }}/mo</h4>
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

@section('scripts')
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
