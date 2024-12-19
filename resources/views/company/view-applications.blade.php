@extends('components.components.layout')

@section('head')
    <style>
        main {
            margin: 35px 0;
            min-height: 100vh;
        }

        #content {}
    </style>
@endsection
@section('content')
    <div class="w-25 m-2 rounded-4 px-5 py-2 rounded- bg-transparent text-white align-items-center d-flex">
        <button class="btn button rounded-5" onclick="window.location.href='{{ route('company-dashboard') }}'">
            <i class="fa-solid fa-arrow-left mx-auto" style="color:white"></i>

        </button>
        <div class="container">
            <h3>
                Company Applications
            </h3>
        </div>

    </div>
    <div class="p-3 col" id="content">
        <div class="container bg-white rounded-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Application ID</th>
                        <th scope="col">Listing ID</th>
                        <th scope="col">Applicant ID</th>

                        <th scope="col">Name</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <th scope="row">{{ $application->id }}</th>
                            <td>{{ $application->listing_id }}</td>
                            <td>{{ $application->applicant_id }}</td>
                            <td>{{ $application->name }}</td>

                        </tr>
                    @endforeach



                </tbody>
            </table>
            @empty($applications)
                <div class="fluid-container bg-white py-3 text-center fs-2 text-secondary">
                    No Applications Found
                </div>
            @endempty
        </div>
    </div>
@endsection
