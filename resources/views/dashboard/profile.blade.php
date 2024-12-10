@extends('components.components.layout')
@section('head')
    <style>
        :root {
            --bs-modal-width: 1000px;

        }

        .modal-dialog {
            max-width: 700px !important;
        }
    </style>
@endsection
@section('content')
    @use('App\Models\Resume', 'Resume')

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
                @if (session('applicant')->resume)
                    <a class="button text-base  font-semibold text-black" data-bs-target="#viewResume"
                        data-bs-toggle="modal">
                        View Resume
                    </a>
                @endif
            @endif





        </div>
    </div>
    @isset(session('appplicant')->id)

        @if (session('applicant')->resume)
            @php
                $resume = Resume::where('applicant_id', session('applicant')->id)
                    ->get()
                    ->first();
            @endphp
            <div class="modal fade" id="viewResume" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 900px !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">View Resume</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mw-100 container" id="modalBodyContent">
                            <p class="h4">Personal Info</p>
                            <p id="name" class="fw-bold fs-2 m-0">{{ $resume->name }}</p>
                            <small id="email">{{ $resume->email }}</small> | <small
                                id="number">{{ $resume->contact_no }}</small>
                            <p id="address">{{ $resume->address }}</p>


                            <hr>
                            <p class="h4">Work Experience</p>
                            <ul id="work-experience">
                                @php

                                    $work = json_decode($resume->work);

                                @endphp
                                @if ($work != null)
                                    <li>
                                        <span class="fw-bold fs-3"> {{ $work->position }}</span> <br>
                                        <span class="fst-italic"> XYZ Tech Solutions – San Francisco, CA</span>
                                        <br>
                                        <span class="fst-italic">
                                            Jan 2021 – Present
                                        </span> <br>
                                        <p>
                                            Developed and maintained 5+ full-stack web applications using React, Node.js, and
                                            MongoDB,
                                            resulting in
                                            a 25% increase in client engagement.
                                            Led a team of 3 developers to redesign a legacy system, reducing page load times by
                                            40%.
                                            Implemented an automated testing framework, improving code quality and reducing bug
                                            reports
                                            by
                                            15%.
                                        </p>

                                    </li>
                                @else
                                    <h5 class="text-secondary">No Work Experience</h5>
                                @endif

                            </ul>

                            <hr>
                            <p class="h4">Education</p>
                            Highest Educational Attainment:
                            <span class="text-capitalize fw-bold">{{ $resume->education }}</span>

                            <hr>
                            <ul>
                                @php

                                    $education = json_decode($resume->educational_background);

                                @endphp
                                @if ($education != null)
                                    <li>
                                        <span class="fw-bold fs-4"> Bachelor of Science - Computer Science</span> <br>
                                        <span class="fst-italic"> XYZ Tech Solutions – San Francisco, CA</span>
                                        <br>
                                        <span class="fst-italic">
                                            May 2023
                                        </span> <br>


                                    </li>
                                @else
                                    <h5 class="text-secondary">No Educational Background</h5>
                                @endif

                            </ul>
                            <hr>
                            <p class="h4">Key Skills</p>
                            <ul>
                                @php
                                    $skills = explode(',', $resume->skills);
                                @endphp
                                @if ($skills != null || $skills != '')
                                    @foreach ($skills as $skill)
                                        <li class="text-capitalize fs-5">{{ $skill }}</li>
                                    @endforeach
                                @else
                                    <h5 class="text-secondary">No Skills</h5>
                                @endif


                            </ul>
                            <hr>
                            <p class="h4">Reference</p>
                            <ul class="list-unstyled d-flex gap-3">
                                @php
                                    $reference = json_decode($resume->reference);
                                @endphp
                                @if ($reference != null)
                                    <li class="list-inline-item">
                                        {{ $reference->name }} <br>
                                        {{ $reference->position }} <br>
                                        {{ $referece->company }} <br>
                                        Phone: {{ $reference->contact_no }} <br>
                                        Email: {{ $reference->email }} <br>
                                    </li>
                                @else
                                    <h5 class="text-secondary">No Reference</h5>
                                @endif

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endisset


    <div class="container bg-white p-3 rounded-4 mb-5">
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
                        <tr class="">
                            <td scope="row" class="w-25">User ID</td>
                            <td>{{ auth()->user()->id }}</td>
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
                                <td>{{ session('employer')->job_title }}</td>
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
                            @endisset

                        </tbody>
                    </table>
                </div>
            @endisset


        </fieldset>
        <button type="button" class="my-2 p-2 bg-white border button text-base bold text-black" data-bs-toggle="modal"
            data-bs-target="#updateInfoModal" onclick="updateInfo({{ auth()->user() }})">
            Edit Profie Information
        </button>
        <button type="button" class="my-2 p-2 bg-white border button text-base bold text-black" data-bs-toggle="modal"
            data-bs-target="#updatePassword" onclick="updateInfo({{ auth()->user() }})">
            Change Password
        </button>
    </div>

    {{-- UPDATE PROFILE MODAL  --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" method="POST" action="{{ route('profile') }}" id="form-profile"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="text" class="form-control" name="profile" id="profile" value="update-profile"
                        hidden>

                    <input type="file" class="form-control" name="profile">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('form-profile').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- UPDATE INFO MODAL --}}
    <div class="fade modal" id="updateInfoModal" tabindex="-1" aria-labelledby="updateInfoModal" aria-hidden="true">
        <div class="modal-dialog bg-white">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" method="POST" action="{{ route('profile') }}" id="form-info"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="text" hidden name="update-info" value="profile-info">
                    <div class="mb-3">
                        <label for="" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname"
                            aria-describedby="helpId" placeholder="" />
                        @error('fname')
                            <small id="helpId" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname"
                            aria-describedby="helpId" placeholder="" />
                        @error('lname')
                            <small id="helpId" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" name="birthdate" id="birthdate"
                            aria-describedby="helpId" placeholder="" />
                        @error('birthdate')
                            <small id="helpId" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('form-info').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Update Password Modal -->
    <div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="modal-body" action="{{ route('profile') }}" method="post" id="passwordForm">
                    @csrf
                    @method('patch')
                    <input type="text" hidden name="update-password" value="true">
                    <div class="mb-3">
                        <label for="" class="form-label">Current Password</label>
                        <input type="text" class="form-control" name="current" id=""
                            aria-describedby="helpId" placeholder="" value="{{ old('current') }}" />
                        @error('current')
                            <small id="helpId" class="form-text text-danger text-muted">Help text</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="text" class="form-control" name="password" id=""
                            aria-describedby="helpId" placeholder="" />
                        @error('password')
                            <small id="helpId" class="form-text text-danger text-muted">Help text</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm New Password</label>
                        <input type="text" class="form-control" name="password_confirmation" id=""
                            aria-describedby="helpId" placeholder="" />
                        @error('password_confirmation')
                            <small id="helpId" class="form-text text-danger text-muted">Help text</small>
                        @enderror
                    </div>

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('passwordForm').submit()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function updateInfo(obj) {
            const fname = $('#fname');
            const lname = $('#lname');
            const email = $('#email');
            const bday = $('#birthdate');

            console.log(obj);
            fname.val(obj.fname);
            lname.val(obj.lname);
            email.val(obj.email);
            bday.val(obj.birthdate);

        }
    </script>
@endsection
