@extends('components.components.layout')
@section('head')
@endsection
@section('content')
    <a class="button hover:bg-slate-100 w-50 mx-auto my-5" href="{{ route('listings') }}"><i
            class="fa-solid fa-arrow-left mx-auto"></i>
        Go
        Back</a>

    <div class="row gap-2 p-3 w-100">
        <div class="col">
            <div class="cnt-1  bg-white ">
                <div class=" gap-5 d-flex ">
                    <div class="col">
                        <table class="table">

                            <tbody>
                                <tr>
                                    <td scope="row">Position</td>
                                    <td>Intern</td>
                                </tr>
                                <tr>
                                    <td scope="row">Location</td>
                                    <td>{{ $internship->location }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Salary</td>
                                    <td>{{ $internship->salary }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Minimum Educational Attainment</td>
                                    <td>{{ $internship->education }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Email</td>
                                    <td>{{ $internship->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="row">Employer ID</td>
                                    <td>{{ $internship->employer_id }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Employer</td>
                                    <td>{{ $internship->company }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Company ID</td>
                                    <td>{{ $internship->companyID }}</td>
                                </tr>
                                <tr>

                                    <td scope="row">Company</td>
                                    <td>{{ $internship->company }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form method="post" action="{{ route('view-internship', $internship->id) }}" class="row" id="form"
                    hidden>

                    @csrf
                    @isset(session('applicant')->id)
                        <input type="text" hidden name="applicant_id" value="{{ session('applicant')->id }}">
                    @endisset
                    <input type="text" hidden name="employer_id" value="{{ $internship->employer_id }}">
                    <input type="text" hidden name="companyID" value="{{ $internship->companyID }}">
                    <input type="text" hidden name="listing_id" value="{{ $internship->id }}">
                    <input type="text" hidden name="type" value="internship">
                </form>

                <button onclick="document.getElementById('form').submit()" class="button bg-primary">Apply Now</button>
            </div>
            <div class="cnt-1 bg-white container box-shadow-1 mt-3">
                <ul>
                    <li>We are looking for a motivated and results-driven Business Account Manager to join our team. In
                        this role, you will be responsible for managing and nurturing relationships with key clients,
                        ensuring their needs are met and identifying opportunities for growth.
                    </li>
                    <li>The ideal candidate will have excellent communication and negotiation skills, along with a
                        strong understanding of business strategy and market trends.
                    </li>
                    <li>You will collaborate with internal teams to deliver tailored solutions, drive customer
                        satisfaction, and achieve sales targets. If you're passionate about building lasting
                        partnerships and driving success, we invite you to apply!</li>
                </ul>
            </div>
        </div>
        <div class="cnt-1 bg-white w-25">
            minimum requirements
        </div>

    </div>
    <div class="d-flex flex-column align-items-end justify-content-end z-50 bottom-0 start-0 position-fixed w-100">

        @error('failed')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('position')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @error('resume')
            <div class="alert alert-warning alert-dismissible fade show position-fixed bg-danger end-0 bottom-0 mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed bg-success end-0 bottom-0 mx-2 col-sm-4 text-bg-success"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Success!</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection
