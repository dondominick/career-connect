@extends('components.components.layout')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection
@section('content')
    @if (session('employers'))
        <div class="container mt-5 position-fixed bottom-0 end-0 mw-25 w-50 z-3">
            <!-- Dismissible Alert -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('employers') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="container-fluid my-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-2 border border-primary pt-2 bg-white gap-2 d-flex flex-column rounded-end-3">

                <div class="ps-4 pb-3 d-flex flex-column align-items-end">



                    <div class="collapse ms-4" id="employeeDropdown">
                        <ul class="list-unstyled">
                            <li class="pb-1"><a href="{{ route('create-employer') }}"
                                    class="text-dark text-decoration-none">Add New Position</a>
                            </li>
                            <li><a href="{{ route('view-employers') }}" class="text-dark text-decoration-none">View All
                                    Positions</a></li>
                        </ul>
                    </div>

                </div>
                <button class="w-100 bg-transparent border-0  btn button d-flex align-items-center"
                    onclick="window.location.href = '{{ route('profile') }}'">

                    <i class="fa-solid fa-arrow-left fs-2 py-1"></i>
                    <h6 class="ps-3 d-inline">Go Back</h6>

                </button>
                <button class="w-100 bg-transparent border-0  btn button d-flex align-items-center"
                    onclick="window.location.href = '{{ route('company-applications') }}'">

                    <i class="fa-solid fa-person fs-2 py-1"></i>
                    <h6 class="ps-3 d-inline">Application</h6>

                </button>
                <button class="w-100 bg-transparent border-0  btn button d-flex align-items-center"
                    onclick="window.location.href = '{{ route('company-listings') }}'">

                    <i class="fa-solid fa-person fs-2 py-1"></i>
                    <h6 class="ps-3 d-inline">Listings</h6>

                </button>
                <button class="w-100 bg-transparent border-0  btn button d-flex align-items-center"
                    onclick="window.location.href = '{{ route('view-employers') }}'">

                    <i class="fa-solid fa-person fs-2 py-1"></i>
                    <h6 class="ps-3 d-inline">Employers</h6>

                </button>



                <button class="w-100 bg-transparent border-0  btn button d-flex align-items-center"
                    onclick="window.location.href = '{{ route('company-info') }}'">

                    <i class="fa-solid fa-gear fs-2 py-1"></i>
                    <h6 class="ps-3 d-inline">Company Info</h6>

                </button>
            </div>

            <!-- Right Column (Dashboard) -->
            <div class="col-10">
                <div class=" p-2 d-flex justify-content-between align-items-center bg-white rounded-3">
                    <h4 class="ps-3">Company Dashboard</h4>

                    <form class="d-flex me-2">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </div>
                <!-- Right Column (Cards) -->
                <div class="p-2 mt-2 bg-white rounded-3">
                    <div class="row mt-2 ">
                        <div class="d-flex justify-content-between align-items-center ps-4">
                            <div>
                                <h1 class="ps-3">Welcome, {{ session('employer')->fname }}</h1>
                                <p class="text-muted ps-3">Check out latest updates</p>
                            </div>

                            <div class="d-flex align-items-center p-3 m-3 border rounded">
                                <img src=" {{ asset('public_img/calendar_11084439.png') }}" alt="image" class="img-fluid"
                                    style="width: 20px; height: 20px;">
                                <span class="ms-2">{{ date('D | M d , Y') }}</span>
                            </div>
                        </div>
                        @foreach ($applications as $application)
                            <div class="col-md-4 mb-3 ">
                                <div class="card text-center">
                                    <div class="card-header">
                                        Application
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ session('company')->companyIndustry }}</h5>
                                        <p class="card-text">{{ $application->name }} would like to apply for the position
                                            of Data
                                            Analyst.
                                        </p>
                                        <a href="{{ route('company-applications') }}" class="btn btn-primary">Check the
                                            application</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        1 day ago
                                    </div>
                                </div>

                            </div>
                        @endforeach


                        @if ($applications->count() == 0)
                            <div class="mx-auto text-center my-5">
                                <h1>No Applications</h1>

                            </div>
                        @endif
                    </div>

                    <!-- Button below the cards -->


                    @if ($applications->count() > 0)
                        <div class="d-grid gap-2 col-6 mx-auto mt-3 mb-5">
                            <button onclick="window.location.href = '{{ route('company-applications') }}'"
                                class="btn btn-primary btn-lg" type="button">View all applications</button>
                        </div>
                    @endif

                    <div class="card m-4">
                        <div class="card-header">
                            <h3>Job Position</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Department</th>
                                        <th scope="col">Job Position</th>
                                        <th scope="col">Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listings as $listing)
                                        <tr>
                                            <td>{{ session('company')->companyIndustry }}</td>
                                            <td>{{ $listing->position }}</td>
                                            <td>{{ $listing->min_salary }} - {{ $listing->max_salary }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <button onclick="window.location.href = '{{ route('company-listings') }}'"
                                class="btn btn-primary btn-md" type="button">Manage Job Position</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-col">
        @if (session('employers'))
            {{ session('employers') }}
        @endif
    </div>
@endsection
