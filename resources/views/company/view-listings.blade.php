@extends('components.components.layout')

@section('head')
    <style>
        .toggle-container {
            position: relative;
            display: inline-flex;
            width: 300px;
            border-radius: 25px;
            overflow: hidden;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            border-radius: 25px;
            transition: all 0.3s ease;
            z-index: 1;
        }

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

        .toggle-button.active {
            color: #333;
        }

        #toggle-option-1:checked~.slider {
            left: 50%;
        }

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
    <div class="w-25 m-2 rounded-4 px-5 py-2 rounded- bg-transparent text-white align-items-center d-flex">
        <button class="btn button rounded-5" onclick="window.location.href='{{ route('company-dashboard') }}'">
            <i class="fa-solid fa-arrow-left mx-auto" style="color:white"></i>


        </button>
        <div class="container">
            <h4>
                Company Listings
            </h4>
        </div>

    </div>

    <div class="p-3 container w-100 rounded-3 text-center">
        <div class="toggle-container my-5 mx-auto">
            <div class="slider"></div>
            <div class="btn-group w-100">
                <button for="toggle-option-0" class="toggle-button border-0 bg-white" onclick="activeButton(1)">
                    Listings
                </button>
                <button for="toggle-option-1" class="toggle-button border-0 bg-dark text-white" onclick="activeButton(2)">
                    Internships
                </button>
            </div>
        </div>

    </div>

    <div class="container-fluid py-3">
        <div class="container shadow-sm p-4 bg-light rounded" id="listings">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">Listing ID</th>
                        <th scope="col" class="text-center">Date Created</th>
                        <th scope="col" class="text-center">Position</th>
                        <th scope="col" class="text-center">Employer Name</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($listings)
                        @foreach ($listings as $listing)
                            <tr>
                                <th scope="row">{{ $listing->id }}</th>
                                <td>{{ $listing->created_at->format('Y-m-d') }}</td>
                                <td>{{ $listing->position }}</td>
                                <td>{{ $listing->fname }} {{ $listing->lname }}</td>
                                <td class="text-success">Open</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-muted">No listings available.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
    </tbody>
    </table>
    </div>


    <div class="container-fluid py-3" style="display: none;" id="internships">
        <div class="container shadow-sm p-4 bg-light rounded">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Internships ID</th>
                        <th scope="col">Applicant ID</th>
                        <th scope="col">Application ID</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($internships)
                        @foreach ($internships as $internship)
                            <tr>
                                <th scope="row">{{ $internship->id }}</th>
                                <td>{{ $internship->applicant_id }}</td>
                                <td>{{ $internship->application_id }}</td>
                                <td>{{ $internship->name }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted">No internships available.</td>
                        </tr>
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
