@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .modal-dialog {
            max-width: 900px !important;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex flex-column align-items-end justify-content-end z-50 bottom-0 start-0 position-fixed w-100">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-relative mx-2 col-sm-4" role="alert">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <strong>Success!</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
    <a class="btn bg-white" href="{{ route('employer-dashboard') }}">Go Back</a>

    <form action="{{ route('statusCheck') }}" hidden id="view-status" method="post">
        @csrf
        <input type="text" name="listing_id" hidden id="listing_id" value="{{ $listing->id }}">
        <input type="text" name="status" hidden id="status" value="">
        <input type="text" name="type" hidden id="type" value="listings">
    </form>
    <div class="col">
        <div class="row bg-white rounded p-2 my-2 mx-auto mw-75">
            <h3>Listing Details</h3>
            <table class="table">
                <tr>
                    <td>Listing ID</td>
                    <td>{{ $listing->id }}</td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>{{ $listing->position }}</td>
                </tr>
                <tr>
                    <td>Salary</td>
                    <td>${{ $listing->min_salary }}/mo - ${{ $listing->max_salary }} /mo</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>{{ $listing->location }}</td>
                </tr>
            </table>
        </div>
        <div class="row bg-white rounded p-2 my-2 mx-auto mw-75 d-flex">
            <div class="col">
                <h4>Amount of Application:</h4>
                <p>{{ $applications->count() }}</p>
            </div>
            <div class="col align-items-center d-flex justify-content-end gap-2">
                <button class="btn bg-primary" onclick="checkStatus('accepted')">
                    View Accepted Applications
                </button>
                <button class="btn bg-danger" onclick="checkStatus('rejected')">
                    View Rejected Applications
                </button>


            </div>
        </div>
        <div class="row bg-white rounded p-2 my-2 mx-auto mw-75">
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
                                    <td>Email</td>
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
                <h4>No applicants have applied to your listing</h4>
            @endempty
        </div>

    </div>

    <form action="{{ route('view-details', $listing->id) }}" method="post" hidden id="application-form">
        @csrf
        @method('patch')
        <input type="text" hidden name="type" value="listings">
        <input type="text" hidden value="{{ $listing->id }}" name="listing_id">

        <input type="text" hidden name="applicant_id" id="applicant-id">
        <input type="text" hidden name="status" id="status_ap">

    </form>


    {{-- Modal --}}
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
        const form = document.getElementById('application-form');
        const input_status = document.querySelector('#status');
        const input_id = document.querySelector('#applicant-id');

        function updateApplication(id, status) {
            const form = document.getElementById('application-form');
            const input_status = document.querySelector('#status_ap');
            const input_id = document.querySelector('#applicant-id');


            input_status.value = status;
            input_id.value = id;

            console.log(input_status.value)

            form.submit();

        }
    </script>

    <script>
        // // Get the modal element
        // const dynamicModal = document.getElementById('dynamicModal');

        // // Event listener for the modal show event
        // dynamicModal.addEventListener('show.bs.modal', function(event) {
        //     const button = event.relatedTarget; // Button that triggered the modal
        //     const title = button.getAttribute('data-title'); // Extract info from data-* attributes
        //     const content = button.getAttribute('data-content');

        //     // Reform data-content from json format into a more readable format
        //     //  const obj = json.parse(content);
        //     // Update the modal's title and body content
        //     const modalTitle = dynamicModal.querySelector('.modal-title');
        //     const modalBody = dynamicModal.querySelector('.modal-body');


        //     // Optional: Update confirm button action based on content
        //     const confirmButton = document.getElementById('confirmButton');
        //     if (title === 'Delete Confirmation') {
        //         confirmButton.style.display = 'inline-block';
        //         confirmButton.textContent = 'Delete';
        //         confirmButton.classList.remove('btn-primary');
        //         confirmButton.classList.add('btn-danger');
        //     } else {
        //         confirmButton.style.display = 'none';
        //     }
        // });

        function checkStatus(val) {
            const form = document.getElementById('application-form');
            const input_status = document.querySelector('#status');
            const input_id = document.querySelector('#applicant-id');

            const viewStatus = $('#view-status');
            const status = $('#status');

            status.val(val);

            viewStatus.submit()
        }

        function Reference(name, position, company, email, contact_no) {}

        function ResumeModal(obj) {

            const modalBody = document.getElementById('modalBodyContent');
            const work = JSON.parse(obj.work);
            const educational = JSON.parse(obj.educational_background);
            const reference = new Reference();
            reference.position = "";
            reference.name = "";
            reference.company = "";
            reference.email = "";
            reference.contact_no = "";


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
