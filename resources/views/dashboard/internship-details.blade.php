@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <a class="btn bg-white" href="{{ route('employer-dashboard') }}">Go Back</a>

    <div class="col">
        <div class="row bg-white rounded p-2 my-2 mx-auto mw-75">
            <h3>Listing Details</h3>
            <table class="table">
                <tr>
                    <td>Internship ID</td>
                    <td>{{ $listing->id }}</td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>Intern</td>
                </tr>
                <tr>
                    <td>Salary</td>
                    <td>{{ $listing->salary }}</td>
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
                <p>10</p>
            </div>
            <div class="col align-items-center d-flex justify-content-end gap-2">
                <button class="btn bg-warning ">
                    Update
                </button><button class="btn bg-danger">
                    Delete
                </button>
            </div>
        </div>
        <div class="row bg-white rounded p-2 my-2 mx-auto mw-75">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Applicant ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody>
                        @isset($applicants)
                            @foreach ($applicants as $applicant)
                                <tr>
                                    <td>{{ $applicant->id }}</td>
                                    <td>{{ $applicant->fname }}</td>
                                    <td>{{ $applicant->lname }}</td>
                                    <td>{{ $applicant->email }}</td>
                                    <td>
                                        <button class="btn">

                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn"></button>
                                    </td>
                                    <td>
                                        <button class="btn"></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            @endisset

            @empty($applicants)
                <h4>No applicants have applied to your listing</h4>
            @endempty
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Get the modal element
        const dynamicModal = document.getElementById('dynamicModal');

        // Event listener for the modal show event
        dynamicModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const title = button.getAttribute('data-title'); // Extract info from data-* attributes
            const content = button.getAttribute('data-content');

            // Update the modal's title and body content
            const modalTitle = dynamicModal.querySelector('.modal-title');
            const modalBody = dynamicModal.querySelector('.modal-body');

            modalTitle.textContent = title;
            modalBody.textContent = content;

            // Optional: Update confirm button action based on content
            const confirmButton = document.getElementById('confirmButton');
            if (title === 'Delete Confirmation') {
                confirmButton.style.display = 'inline-block';
                confirmButton.textContent = 'Delete';
                confirmButton.classList.remove('btn-primary');
                confirmButton.classList.add('btn-danger');
            } else {
                confirmButton.style.display = 'none';
            }
        });
    </script>
@endsection
