@extends('components.components.layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/empForm.css') }}">
@endsection

@section('content')
    <!-- Back Button -->
    <div class="mb-4 text-center">
        <a class="btn btn-primary text-white rounded-pill px-2 py-1 shadow-sm" href="{{ route('company-dashboard') }}">
            <i class="fa-solid fa-arrow-left me-2"></i> Go Back
        </a>
    </div>

    <!-- Employer Form Container -->
    <div class="col-md-8 col-lg-6 mx-auto">
        <div class="p-4 bg-light rounded shadow-sm">
            <h1 class="fw-bold h2 text-center mb-4">Employer Form</h1>

            <!-- Form -->
            <form action="{{ route('create-employer') }}" method="post">
                @csrf
                <input type="hidden" name="companyID" value="{{ session('company')->id }}">
                <input type="hidden" name="company" value="{{ session('company')->companyName }}">

                <!-- Form Fields -->
                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6 mb-3">
                        @error('fname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="form-control" id="First Name" name="fname" placeholder="First Name"
                            value="{{ old('fname') }}">
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6 mb-3">
                        @error('lname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="form-control rounded" id="Last Name" name="lname"
                            placeholder="Last Name" value="{{ old('lname') }}">
                    </div>
                </div>

                <!-- Gender -->
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="mb-3">

                    <label class="form-label me-2"><strong>Gender:</strong></label>
                    <div class="d-flex align-items-center">
                        <input type="radio" id="male" name="gender" value="male" class="me-1">
                        <label for="male" class="me-3">Male</label>
                        <input type="radio" id="female" name="gender" value="female" class="me-1">
                        <label for="female">Female</label>
                    </div>
                </div>

                <!-- Birthdate -->
                <div class="mb-3">
                    <label for="birthdate" class="form-label"><strong>Birthdate</strong></label>
                    @error('birthdate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="date" class="form-control rounded" name="birthdate" id="birthdate"
                        value="{{ old('birthdate') }}">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="text" class="form-control rounded" name="email" placeholder="Email"
                        value="{{ old('email') }}">
                </div>

                <!-- Contact Number -->
                <div class="mb-3">
                    @error('contactNum')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="number" class="form-control rounded" name="contactNum" placeholder="Contact Number"
                        value="{{ old('contactNum') }}">
                </div>

                <!-- Position -->
                <div class="mb-3">
                    @error('position')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="text" class="form-control rounded" name="job_title" placeholder="Position"
                        value="{{ old('job_title') }}">
                </div>

                <!-- Salary -->
                <div class="mb-3">
                    @error('salary')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="text" class="form-control rounded" name="salary" placeholder="Salary"
                        value="{{ old('salary') }}">
                </div>

                <!-- Password -->
                <div class="mb-3">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="password" class="form-control rounded" name="password" placeholder="Password">
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <input type="password" class="form-control rounded" name="password_confirmation"
                        placeholder="Confirm Password" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function limitToOneDigit(input) {
            // Ensure the input value only contains a single digit (0-9)
            input.value = input.value.slice(0, 1);
        }
    </script>
@endsection
