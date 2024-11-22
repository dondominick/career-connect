@extends('components.components.layout')
@section('content')
    <div class="w-50 m-2 rounded-4 px-5 py-2 rounded- bg-white align-items-center d-flex">
        <button class="btn button rounded-5" onclick="window.location.href='{{ route('company-dashboard') }}'">
            <i class="fa-solid fa-arrow-left mx-auto"></i>

        </button>
        <div class="container">
            <h3>
                Company Applications
            </h3>
        </div>

    </div>
    <div class="p-3 row">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Application ID</th>
                        <th scope="col">Listing ID</th>
                        <th scope="col">Applicant ID</th>

                        <th scope="col">Name</th>
                        <th scope="col" class="w-25">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td class="w-25"></td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
            @empty($applications->id)
                <div class="fluid-container bg-white py-3 text-center fs-2">
                    No Applications Found
                </div>
            @endempty
        </div>
    </div>
@endsection
