@extends('components.components.layout')

@section('head')
    <style>
        .toggle-container {
            position: relative;
            display: inline-flex;
            width: 300px;
            background: linear-gradient(135deg, #b0c4de, #9cc0e7);
            border-radius: 25px;
            overflow: hidden;
        }

        /* Background slider */
        .slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            background-color: #ffdab9;
            border-radius: 25px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        /* Button styles */
        .toggle-button {
            flex: 1;
            text-align: center;
            padding: 5px 0;
            font-size: 16px;
            font-weight: bold;
            color: #555;
            z-index: 2;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        /* Active state for button text */
        .toggle-button.active {
            color: #333;
        }

        /* CSS to move the slider to the second position */
        #toggle-option-1:checked~.slider {
            left: 50%;
        }

        /* Style for the active text in each option */
        #toggle-option-0:checked~.btn-group .toggle-button:first-of-type,
        #toggle-option-1:checked~.btn-group .toggle-button:last-of-type {
            color: #333;
        }

        /* Hide radio buttons */
        .toggle-radio {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="w-50 m-2 rounded-4 px-5 py-2 rounded- bg-white align-items-center d-flex">
        <button class="btn button rounded-5" onclick="window.location.href='{{ route('company-dashboard') }}'">
            <i class="fa-solid fa-arrow-left mx-auto"></i>

        </button>
        <div class="container">
            <h3>
                Company Listings
            </h3>
        </div>

    </div>
    <div class="p-3 container w-100 rounded-3 text-center">
        <div class="toggle-container my-5 mx-auto">

            <!-- Slider background -->
            <div class="slider"></div>

            <!-- Labels as buttons -->
            <div class="btn-group w-100">
                <button for="toggle-option-0" class="toggle-button border-0 bg-primary" onclick="activeButton(1)">
                    Listings
                </button>
                <button for="toggle-option-1" class="toggle-button border-0 bg-secondary" onclick="activeButton(2)">
                    Internships
                </button>
            </div>
        </div>

    </div>
    <div class="fluid-container">
        <div class="container" id="listings">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Listing ID</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Position</th>

                        <th scope="col">Employer Name</th>
                        <th>Status</th>
                        <th scope="col" class="w-25">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @isset($listings)
                        @foreach ($listings as $listing)
                            <tr>
                                <th scope="row">{{ $listing->id }}</th>
                                <td>{{ $listing->created_at }}</td>
                                <td>{{ $listing->position }}</td>
                                <td>{{ $listing->fname }} {{ $listing->lname }}</td>
                                <td class="">Open</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endisset



                </tbody>
            </table>
        </div>
        <div class="container" id="internships" style="display: none">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Internships ID</th>
                        <th scope="col">Applicant ID</th>
                        <th scope="col">Application ID</th>

                        <th scope="col">Name</th>
                        <th scope="col" class="w-25">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @isset($intenrships)
                        @foreach ($internships as $internship)
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="w-25"></td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            const internships = $('#internships');
            internships.hide()
        });

        function activeButton(num) {
            const listing = $('#listings');
            const internships = $('#internships');
            if (num == 1) {
                listing.show();
                internships.hide();
            } else {
                listing.hide();
                internships.show();
            }


        }
    </script>
@endsection
