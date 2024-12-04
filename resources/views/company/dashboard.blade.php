@extends('components.components.layout')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection
@section('content')
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

                        <div class="col-md-4 mb-3 ">
                            <div class="card text-center">
                                <div class="card-header">
                                    Application
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Technology Department</h5>
                                    <p class="card-text">Aaron Lanos would like to apply for the position of Data Analyst.
                                    </p>
                                    <a href="#" class="btn btn-primary">Check the application</a>
                                </div>
                                <div class="card-footer text-muted">
                                    1 day ago
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-header">
                                    Application
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Production Department</h5>
                                    <p class="card-text">Joren Naungayan would like to apply for the position of Machine
                                        Operator.</p>
                                    <a href="#" class="btn btn-primary">Check the application</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-header">
                                    Application
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Finance Department</h5>
                                    <p class="card-text">Sherwin Montealto would like to apply for the position of
                                        Accountant..</p>
                                    <a href="#" class="btn btn-primary">Check the application</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button below the cards -->
                    <div class="d-grid gap-2 col-6 mx-auto mt-3 mb-5">
                        <button class="btn btn-primary btn-lg" type="button">View all applications</button>
                    </div>
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
                                        <th scope="col">Applicant's</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Technology Department</td>
                                        <td>Data Analyst</td>
                                        <td>Aaron Lanos</td>
                                    </tr>
                                    <tr>
                                        <td>Production Department</td>
                                        <td>Mahine Operator</td>
                                        <td>Joren Naungayan</td>
                                    </tr>
                                    <tr>
                                        <td>Finance Department</td>
                                        <td>Accountant</td>
                                        <td>Sherwin Montealto</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <button class="btn btn-primary btn-md" type="button">Manage Job Position</button>
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
