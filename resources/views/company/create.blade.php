@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/empForm.css') }}">
@endsection
@section('content')
    <a class="button hover:bg-slate-100 w-50 mx-auto" href="{{ route('company-dashboard') }}"><i
            class="fa-solid fa-arrow-left mx-auto"></i>
        Go
        Back</a>



    <div class="col-md-6 col-lg-6 mx-auto">
        <div class="p-5 bgColor">
            <h1 class="fw-bold h2 text-center mb-5">Employer Form</h1>
            <!--FORM-->
            <form action="{{ route('create-employer') }}" method="post">
                @csrf
                <input type="text" hidden name="companyID" value="{{ session('company')->id }}">
                <input type="text" hidden name="company" value="{{ session('company')->companyName }}">



                <div class="row">
                    <!--First Name-->
                    <div class="col mb-3">
                        @error('fname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="inputDesign" id="First Name" placeholder="First Name" name="fname"
                            value="{{ old('fname') }}">
                    </div>
                    <!--Last Name-->
                    <div class="col mb-3">
                        @error('lname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="inputDesign" id="Last Name" placeholder="Last Name" name="lname"
                            value="{{ old('lname') }}">
                    </div>
                    <!--Age-->
                    {{-- <div class="mb-2">
                        <label for="age" class="form-label me-2 "><strong>Age: </strong></label>
                        <input type="number" min="0" max="9" step="1" class="ageInput" id="age"
                            oninput="limitToOneDigit(this)" required>
                        <input type="number" min="0" max="9" step="1" class="ageInput" id="age"
                            oninput="limitToOneDigit(this)" required>
                    </div> --}}
                    <!--Gender-->
                    <div class="mb-3">
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <label for="gender" class="form-label me-2"><strong>Gender: </strong></label>
                        <input type="radio" id="male" name="gender" placeholder="Gender" value="male">
                        <label for="male" class="me-1">Male</label>
                        <input type="radio" id="female" name="gender" placeholder="Gender" value="female">
                        <label for="female">Female</label>
                    </div>
                    {{-- Birthdate --}}
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Birthdate </strong></label>
                        @error('birthdate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="date" class="form-control" name="birthdate" id="birthdate">
                    </div>
                    <!--Email-->
                    <div class="mb-3">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="inputDesign" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                    </div>

                    <!--Contact Num-->
                    <div class="mb-3">
                        @error('contactNum')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="number" class="inputDesign" name="contactNum" placeholder="Contact Number"
                            value="{{ old('contactNum') }}">
                    </div>
                    <!--Postion-->
                    <div class="mb-3">
                        @error('position')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="inputDesign" name="position" placeholder="Position"
                            value="{{ old('position') }}">
                    </div>
                    <!--Salary-->
                    <div class="mb-3">
                        @error('salary')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="text" class="inputDesign" name="salary" placeholder="Salary"
                            value="{{ old('salary') }}">
                    </div>
                    <!--Password-->
                    <div class="mb-3">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="password" class="inputDesign" name="password" placeholder="Password">
                    </div>
                    <!--Confirm Password-->
                    <div class="mb-3">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="password" class="inputDesign" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                </div>



                <div class="row">
                    <!--Submit BTN-->
                    <div class="col-2"></div>
                    <button type="submit" class="col btn btn-success py-2 px-4 mt-3 text-dark">Submit</button>
                    <div class="col-2"></div>
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
