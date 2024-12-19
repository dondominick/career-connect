@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        #displayBox {
            min-height: 100vh
        }
    </style>
@endsection
@section('content')
    <div class="my-3 d-flex flex-column align-items-end justify-content-end w-100">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-relative mx-2 col-sm-4" role="alert">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <strong>Success!</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
    <a class="btn bg-white" href="{{ url()->previous() }}">Go Back</a>

    <div class="bg-white rounded p-3 my-2 mx-5 mw-75" id="displayBox">
        <h1>Rejected Applicants</h1>

        @isset($applications)
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Applicant ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->applicant_id }}</td>
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->email }}</td>
                                <td>
                                    <button type="button" class="btn bg-warning rounded-5" data-bs-toggle="modal"
                                        data-title="Applicant ID: {{ $application->applicant_id }}"
                                        data-content="{{ $application->resume }}" data-bs-target="#dynamicModal">
                                        <i class="fa-solid fa-file"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="submit" class="btn bg-success rounded-5"
                                        onclick="updateApplication({{ $application->applicant_id }}, 'accepted')">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="submit" class="btn bg-danger rounded-5"
                                        onclick="updateApplication({{ $application->applicant_id }}, 'rejected')">
                                        <i class="fa-regular fa-circle-xmark"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endisset

        @empty($applications)
            <h4>There are no accepted applicants in your listing</h4>
        @endempty
    </div>
@endsection

@section('scripts')
@endsection
