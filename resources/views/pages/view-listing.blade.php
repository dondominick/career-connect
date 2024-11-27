@extends('components.components.layout')
@section('head')
@endsection
@section('content')
    <a class="button hover:bg-slate-100 w-50 mx-auto" href="{{ route('listings') }}"><i
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
                                    <td>{{ $listing->position }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Location</td>
                                    <td>{{ $listing->location }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Minimum Education Attainment</td>
                                    <td>{{ $listing->education }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Salary</td>
                                    <td>{{ $listing->salary }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="row">Employer ID</td>
                                    <td>{{ $listing->employer_id }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Employer Name</td>
                                    <td>{{ $listing->employer_id }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Email</td>
                                    <td>{{ $listing->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form method="post" action="{{ route('view-listing', $listing->id) }}" class="row" id="form"
                    hidden>
                    @csrf
                    @isset(session('applicant')->id)
                        <input type="text" hidden name="applicant_id" value="{{ session('applicant')->id }}">
                    @endisset <input type="text" hidden name="employer_id" value="{{ $listing->employer_id }}">
                    <input type="text" hidden name="companyID" value="{{ $listing->companyID }}">
                    <input type="text" hidden name="listing_id" value="{{ $listing->id }}">
                    <input type="text" hidden name="type" value="listings">
                </form>

                <button onclick="document.getElementById('form').submit()" class="button bg-primary">Apply Now</button>


            </div>
            <?php $description = json_decode($listing->description); ?>
            <div class="cnt-1 bg-white container box-shadow-1 mt-3">
                <h3>Description</h3>
                <ul>
                    @isset($description)
                        @foreach ($description as $i)
                            @if ($i)
                                <li>
                                    {{ $i }}
                                </li>
                            @endif
                        @endforeach
                    @endisset


                </ul>
            </div>
        </div>
        <?php $requirements = json_decode($listing->requirements); ?>
        <div class="cnt-1 bg-white w-25">
            <h3>Requirements</h3>
            <ul>
                @isset($requirements)
                    @foreach ($requirements as $i)
                        @if ($i)
                            <li>
                                {{ $i }}
                            </li>
                        @endif
                    @endforeach
                @endisset

            </ul>
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

        @isset($success)
            <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $message }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endisset
    </div>
@endsection
