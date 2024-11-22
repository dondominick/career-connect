@extends('components.components.layout')
@section('head')
@endsection
@section('content')
    @isset($sucessful)
        <div class="container mt-5 position-fixed bottom-0 end-0 mw-25 w-50 z-3">
            <!-- Dismissible Alert -->
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @enderror
    <div class="d-flex  justify-content-between rounded mt-5">
        <div class="mw-25 w-25 bg-white  rounded-end-5 px-4 py-3 mh-50">

            <a class="button hover:bg-slate-100 d-block" href="{{ route('profile') }}"><i
                    class="fa-solid fa-arrow-left mx-auto"></i>
                Go
                Back</a>

            <a href="{{ route('create-listing') }}" class="d-block button hover:bg-slate-100">Create Listing</a>
            <a href="{{ route('create-internship') }}" class="button d-block hover:bg-slate-100">Create
                Internship</a>

        </div>
        <div class="container mw-70 ms-5 px-4 py-3 bg-white rounded-start-4 border">

            @isset($listings)
                @foreach ($listings as $listing)
                    <div class="p-2 border-bottom border-3">
                        <div class="container">
                            <div class="table-responsive-sm">
                                <table class="table table-white">

                                    <tbody>
                                        <tr class="">
                                            <td scope="row">Listing ID</td>
                                            <td>{{ $listing->id }}</td>
                                        </tr>
                                        <tr class="">
                                            <td scope="row">Position</td>
                                            <td>
                                                {{ $listing->position }}
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td scope="row">Salary</td>
                                            <td>
                                                {{ $listing->salary }}
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td scope="row">Location</td>
                                            <td>{{ $listing->location }}</td>
                                        </tr>

                                        <tr class="">
                                            <td scope="row">Educational Attainment</td>
                                            <td>{{ $listing->education }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <hr>
                        <div class="container-3">
                            <form action="{{ route('delete-listing') }}" method="post" hidden
                                id="listing-{{ $listing->id }}">
                                @csrf
                                @method('delete')
                                <input type="text" hidden value="{{ $listing->id }}" name="id">
                            </form>
                            <a href="{{ route('update-listing', $listing->id) }}" class="btn bg-primary"><i
                                    class="fa-sharp-duotone fa-solid fa-pen-to-square"></i></a>
                            <button type="button" onclick="document.getElementById('listing-{{ $listing->id }}').submit()"
                                class="btn bg-danger"><i class="fa-sharp-duotone fa-solid fa-trash-can"></i></button>
                            <a href="{{ route('view-details', $listing->id) }}" class="btn bg-warning">
                                <i class="fa-solid fa-info"></i></a>
                        </div>
                    </div>
                @endforeach
            @endisset

            @isset($internships)
                @foreach ($internships as $internship)
                    <div class="p-2 border-bottom border-3">
                        <div class="container">
                            <div class="table-responsive-sm">
                                <table class="table table-white">

                                    <tbody>
                                        <tr class="">
                                            <td scope="row">Internship ID</td>
                                            <td>{{ $internship->id }}</td>
                                        </tr>
                                        <tr class="">
                                            <td scope="row">Position</td>
                                            <td>Intern</td>
                                        </tr>
                                        <tr class="">
                                            <td scope="row">Salary</td>
                                            <td>{{ $internship->salary }}</td>
                                        </tr>
                                        <tr class="">
                                            <td scope="row">Location</td>
                                            <td>{{ $internship->location }}</td>
                                        </tr>

                                        <tr class="">
                                            <td scope="row">Educational Attainment</td>
                                            <td>{{ $internship->education }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <hr>
                        <div class="container-3">
                            <a href="{{ route('update-internship', $internship->id) }}" class="btn bg-primary"><i
                                    class="fa-sharp-duotone fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('delete-internship') }}" method="post" hidden
                                id="intern-{{ $internship->id }}">
                                @method('delete')
                                @csrf
                                <input type="text" hidden name="id" value="{{ $internship->id }}">
                            </form>
                            <button type="button" onclick="document.getElementById('intern-{{ $internship->id }}').submit()"
                                class="btn bg-danger"><i class="fa-sharp-duotone fa-solid fa-trash-can"></i></button>
                            <a href="{{ route('internship-details', $internship->id) }}" class="btn bg-warning">
                                <i class="fa-solid fa-info"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endisset




        </div>
    </div>
@endsection
