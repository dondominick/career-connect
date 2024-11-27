@extends('components.components.layout')
@section('head')
    <style>
        .left-side {
            flex: 0 0 25%;
            /* 25% width */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            color: white;
        }

        .right-side {
            margin-top: 10px;
            flex: 0 0 75%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 120px 0 0 120px;
            padding-top: 20px;
            padding-bottom: 15px;
            padding-left: 5px;
        }

        .welcome-image {
            max-width: 100%;
            height: auto;
        }

        .combined-oval {
            background-color: #3931af;
            color: white;
            border-radius: 50px;
            padding: 5px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            width: fit-content;
            margin-left: auto;
        }

        .employee {
            background-color: white;
            color: #3931af;
            border: 2px solid #3931af;
            border-radius: 50px;
            padding: 5px 10px;
            margin-left: 30px;
        }

        .applicant-text {
            color: white;
            margin-left: 5px;
        }

        .form-group {
            margin-bottom: 20px;
            padding: 0 120px;
            font-weight: 700;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #3931af;
            border-radius: 0;
            box-shadow: none;
            padding: 5px 0;
            width: 250px;
        }

        .form-control:focus {
            outline: none;
            border-color: #3931af;
        }

        .oval-button {
            background-color: #3931af;
            color: white;
            border-radius: 50px;
            padding: 10px 10px;
            border: none;
            cursor: pointer;
            width: 60%;
            font-weight: 500;
            margin-right: 100px;
        }

        .oval-button1 {
            background-color: white;
            color: black;
            border-radius: 50px;
            padding: 10px 50px;
            border: none;
            cursor: pointer;
            margin-top: 120px;
        }

        .oval-button:hover {
            background-color: white;
            color: black;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .text-unstyle {
            text-decoration: none;
        }

        #page1:nth-child(0) {
            display: flex;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex w-100">
        <div class="left-side">
            <img src="{{ asset('public_img/logo-careerconnect 1 (1).png') }}" alt="Logo" class="welcome-image" />
            <h1>WELCOME</h1>
            <p>You’re just 1 minute away from starting your exciting journey!</p>
            <button class="oval-button1"><b>Login</b></button>
        </div>

        <div class="right-side">
            <div class="signup-form">
                <div class="combined-oval">
                    <a href="{{ route('sign-up') }}" class="applicant-text text-unstyle">Applicant</a>
                    <a href="#" class="employee text-unstyle">Company</a>
                </div>
                <h2 class="text-center mb-4">Register Company or Business</h2>
                <form class="" action="{{ route('employee-sign-up') }}" method="POST">
                    @csrf

                    <div class="" id="page1">

                        <div class="d-flex">
                            <div>
                                <div class="form-group w-full">
                                    <h4 class="h5">Basic Company Information</h4>

                                </div>
                                <div class="form-group w-100">
                                    <label for="companyName">Company Name</label>
                                    <input type="text" name="companyName" class="form-control" id="companyName"
                                        placeholder="Company Name*" value="{{ old('companyName') }}" />
                                    @error('companyName')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="companyLocation">Company Location</label>
                                    <input type="text" name="companyLocation" class="form-control" name="companyLocation"
                                        placeholder="Company Location*" value="{{ old('companyLocation') }}" />
                                    @error('companyLocation')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="companySize">Company Size</label>
                                    <select class="form-select form-select-sm" name="companySize" id="companySize"
                                        value="{{ old('companySize') }}">
                                        <option value="<10" selected>Less than 10</option>
                                        <option value="11-50">11 - 50 employees</option>
                                        <option value="51-100">51 - 100 employees</option>
                                        <option value=">100">more than 100 employees</option>
                                    </select>

                                    @error('compnaySize')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="companyIndustry">Company Industry</label>
                                    <select class="form-select form-select-sm" name="companyIndustry" id="companyIndustry"
                                        value="{{ old('companyIndustry') }}">
                                        <option selected></option>
                                        <option value="Technology">Technology</option>
                                        <option value="Medicine">Healthcare & Pharmaceuticals</option>
                                        <option value="Finance">Finance & Banking</option>
                                        <option value="Education">Education</option>
                                        <option value="E-commerce">Retail & E-commerce</option>
                                        <option value="Manufacturing">Manufacturing & Industrial</option>
                                        <option value="Energy">Energy & Utilities </option>
                                        <option value="Hospitality">Hospitality & Tourism</option>
                                        <option value="Media">Media & Entertainment</option>
                                        <option value="Construction">Construction & Real Estate</option>
                                        <option value="Logistics">Logistics & Transportation</option>
                                        <option value="Agriculture">Agriculture & Forestry</option>
                                        <option value="Legal Services">Legal & Consulting Services</option>
                                        <option value="Government">Public Sector & Government</option>
                                    </select>

                                    @error('companyIndustry')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>


                            </div>


                            <div>
                                <div class="form-group">
                                    <h4 class="h5">Contact Information - Company </h4>

                                </div>
                                <div class="form-group">
                                    <label for="contact_num">Contact Number</label>
                                    <input type="text" class="form-control" id="companyNum" name="companyNum"
                                        placeholder="Contact Number*" value="{{ old('companyNum') }}" />
                                    @error('companyNum')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="companyEmail">Company Email</label>
                                    <input type="text" class="form-control" id="companyEmail" name="companyEmail"
                                        value="" placeholder="Email Address*" />
                                    @error('companyEmail')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Name of Contact Person<label>
                                            <input type="text" class="form-control" id="contactPerson"
                                                value="{{ old('contactPerson') }}" name="contactPerson"
                                                placeholder="Full Name*" />
                                            @error('contactPerson')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end d-flex">
                            <button class=" oval-button" type="button" onclick="displayPage2()">
                                Next
                            </button>
                        </div>
                    </div>


                    <div id="page2">
                        <div class="d-flex">
                            <div>
                                <div class="form-group w-full border">
                                    <h4 class="h5">Head Employer Information</h4>

                                </div>
                                <div class="form-group w-100 border">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="fname"
                                        placeholder="First Name*" value="{{ old('fname') }}" />
                                    @error('fname')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group w-100 border">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lname"
                                        placeholder="Last Name*" value="{{ old('lname') }}" />
                                    @error('lname')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input border border-black" type="radio" name="gender"
                                            id="male" value="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input border border-black" type="radio" name="gender"
                                            id="female" value="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    @error('gender')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                            </div>


                            <div>
                                <div class="form-group">
                                    <label for="username">Company Position</label>
                                    <input type="text" class="form-control" id="position" name="position"
                                        placeholder="Position" />
                                    @error('position')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username">Contact Number</label>
                                    <input type="text" class="form-control" id="contactNum" name="contactNum"
                                        placeholder="Contact Number*" />
                                    @error('contactNum')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="password">Birthdate</label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate">
                                    @error('birthdate')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password<label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password*" />
                                            @error('password')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password<label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Confirm Password*" />
                                            @error('password_confirmation')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                </div>

                            </div>
                        </div>
                        <div class="border justify-content-between d-flex">
                            <button class="btn btn-block oval-button" type="button" onclick="displayPage1()">Go
                                Back</button>
                            <input class="btn btn-block oval-button" type="submit" value="Login">
                        </div>


                    </div>


                </form>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/employee-register.js') }}"></script>
@endsection
