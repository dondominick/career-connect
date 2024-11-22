@extends('components.components.layout')
@section('head')
@endsection
@section('content')
    <div class="d-flex flex-column align-items-end justify-content-end z-50 bottom-0 start-0 position-fixed w-100">

        @error('profile')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @error('failed')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-relative mx-2 col-sm-4" role="alert">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <strong>Success!</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>

    <div class="container mt-5 bg-white mb-5 d-flex p-3 rounded-4">
        <div class="flex-grow-1 me-auto p-2 d-flex " id="profile_picture">
            <div class="box d-flex align-items-center h-100 profile">
                @if (auth()->user()->profile)
                    <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="profile.png" class="rounded-circle ">
                @else
                    <img src="{{ asset('public_img/default.jpeg') }}" alt="profile.png" class="rounded-circle ">
                @endif

            </div>
            <div class="mx-3 justify-content-center d-flex flex-column" id="profile_details">
                <p class="text-3xl font-bold">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</p>
                <table class="table">
                    <tr class=" border-white">
                        <td class="w-100 font-semibold">
                            @if (auth()->user()->position == 'applicant')
                                Applicant ID: {{ session('applicant')->id }}
                            @else
                                Employer ID: {{ session('employer')->id }}
                            @endif
                        </td>
                        <td class="w-50">


                        </td>
                    </tr>
                    <tr class="border-white font-semibold">
                        <td class="">
                            {{ auth()->user()->position }}
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="container-6  flex-column d-flex">
            <form action="{{ route('logout') }}" style="display: none;" method="POST" id="logout-form">
                @csrf
            </form>
            <a class="button text-base font-semibold text-black"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                href="{{ route('logout') }}">Log
                Out</a>
            <button type="button" class="my-2 p-2 bg-white border button text-base bold text-black" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Change
                Profile
            </button>
            @if (auth()->user()->position == 'company' || auth()->user()->position == 'employer')
                <a class="button text-base  font-semibold text-black" href="{{ route('employer-dashboard') }}">Employer
                    Dashboard</a>
            @endif
            @if (auth()->user()->position == 'company')
                <a class="button text-base  font-semibold text-black" href="{{ route('company-dashboard') }}">
                    Company Dashboard
                </a>
            @endif
            @if (auth()->user()->position == 'applicant')
                <a class="button text-base  font-semibold text-black" href="{{ route('resume') }}">
                    Upload Resume
                </a>
            @endif



        </div>
    </div>
    <div class="container bg-white p-3 rounded-4">
        <fieldset class="mb-4">
            <legend class="">User Information</legend>
            <hr>

            <div class="table-responsive w-100 p-2">
                <table class="border-white w-100 ">

                    <tbody>
                        <tr class="">
                            <td scope="" class="w-25">First Name</td>
                            <td>{{ auth()->user()->fname }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row" class="w-25">Last Name</td>
                            <td>{{ auth()->user()->lname }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row" class="w-25">Birth Date</td>
                            <td>{{ auth()->user()->birthdate }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row" class="w-25">Email</td>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </fieldset>


        <fieldset class="border-x-black border-2">
            @isset(session('employer')->id)
                <legend>Employer Information</legend>
                <hr>
                <div class="table-responsive w-50 p-2 mb-2">
                    <table class="border-white w-100 ">

                        <tbody>
                            <tr class="">
                                <td scope="row">Employer ID</td>
                                <td>{{ session('employer')->id }}</td>


                            </tr>
                            <tr class="">
                                <td scope="row">Employer First Name</td>
                                <td>{{ session('employer')->fname }}</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Employer Last Name</td>
                                <td>{{ session('employer')->lname }}</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Employer Email</td>
                                <td>{{ session('employer')->email }}</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Position / Job Title</td>
                                <td>{{ session('employer')->position }}</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Employer Contact Number</td>
                                <td>{{ session('employer')->contactNum }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endisset
            @isset(session('applicant')->resume)
                <?php $resume = json_decode(session('applicant')->resume); ?>

                <legend>Applicant Information</legend>
                <hr>
                <div class="table-responsive w-50 p-2">
                    <table class="border-white w-100 ">
                        <tbody>
                            <tr class="">
                                <td>Applicant ID</td>
                                <td>{{ session('applicant')->id }}</td>

                            </tr>

                            @isset($resume)
                                <tr class="">
                                    <td scope="row">Name</td>
                                    <td>{{ $resume->name }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Age</td>
                                    <td>{{ $resume->age }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Email</td>
                                    <td>{{ $resume->email }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Address</td>
                                    <td>{{ $resume->address }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Gender</td>
                                    <td>{{ $resume->gender }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Education</td>
                                    <td>{{ $resume->education }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">References</td>
                                    <td>{{ $resume->references }}</td>
                                </tr>
                            @endisset

                        </tbody>
                    </table>
                </div>
            @endisset


        </fieldset>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" method="POST" action="{{ route('profile') }}" id="form-profile"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="file" class="form-control" name="profile" id="profile">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('form-profile').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
