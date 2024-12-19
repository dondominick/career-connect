@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        #displayBox {
            min-height: 100vh
        }

        .modal-dialog {
            max-width: 900px !important;
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
        <h1>Accepted Applicants</h1>

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
                                        onclick="ResumeModal({{ $application }})"
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





    <div class="modal fade" id="dynamicModal" tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dynamicModalLabel">Applicant Resume</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mw-100 container" id="modalBodyContent">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function Reference(name, position, company, email, contact_no) {}

        function ResumeModal(obj) {

            const modalBody = document.getElementById('modalBodyContent');
            const work = JSON.parse(obj.work);
            const educational = JSON.parse(obj.educational_background);
            const reference = new Reference();
            if (JSON.parse(obj.reference) != null) {
                reference = JSON.parse(obj.reference);
            }


            modalBody.innerHTML = `
<p class="h4">Personal Info</p>
        <p id="name" class="fw-bold fs-2 m-0">${obj.name}</p>
        <small id="email">${obj.email}</small> | <small id="number">${obj.contact_no}</small>
        <p id="address">${obj.address}</p>



        <hr>
        <p class="h4">Work Experience</p>
        <ul id="work-experience">
            <li>
                <span class="fw-bold fs-3"> ${work.position}</span> <br>
                <span class="fst-italic"> ${work.company}</span>
                <br>
                <span class="fst-italic">
                ${work.duration}
                </span> <br>
        
            </li>
        </ul>

        <hr>
        <p class="h4">Education</p>
        <ul>
            <li>
                <span class="fw-bold fs-4">${educational.title}</span> <br>
                <span class="fst-italic"> ${educational.school}</span>
                <br>
                <span class="fst-italic">
                ${educational.year}
                </span> <br>


            </li>
        </ul>
        <hr>
        <p class="h4">Key Skills</p>
        <ul>
            
        <li>${obj.skills}</li>
        </ul>
        <hr>
        <p class="h4">Reference</p>
        <ul class="list-unstyled d-flex gap-3">
            <li class="list-inline-item">
                ${reference.name} <br>
                ${reference.position} <br>
                XYZ Tech Solutions <br>
                Phone: (555) 123-4567 <br>
                Email: johndoe@example.com <br>
                Former Manager at XYZ Tech Solutions <br>
            </li>

        </ul>
`;
        }
    </script>
@endsection
