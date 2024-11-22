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
            border: 2px solid black;
            padding-top: 20px;
            padding-bottom: 15px;
            padding-left: 5px;
        }

        .welcome-image {
            max-width: 100%;
            height: auto;
        }

        .combined-oval {
            background-color: #3931AF;
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

        .applicant {
            background-color: white;
            color: #3931AF;
            border: 2px solid #3931AF;
            border-radius: 50px;
            padding: 5px 10px;
            margin-right: 30px;
        }

        .employee-text {
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
            border-bottom: 2px solid #3931AF;
            border-radius: 0;
            box-shadow: none;
            padding: 5px 0;
            width: 250px;
        }

        .form-control:focus {
            outline: none;
            border-color: #3931AF;
        }

        .oval-button {
            background-color: #3931AF;
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
        }

        .form-row {
            margin-bottom: 15px;
        }

        .text-unstyle {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex">
        <div class="left-side">
            <img src="{{ asset('public_img/logo-careerconnect 1 (1).png') }}" alt="Logo" class="welcome-image">
            <h1>WELCOME</h1>
            <p>You’re just 1 minute away from starting your exciting journey!</p>
            <button class="oval-button1"><b>Login</b></button>
        </div>

        <div class="right-side mb-4">
            <form class="signup-form" method="POST" action="{{ route('sign-up') }}">
                @csrf
                @method('POST')
                <div class="combined-oval">
                    <a href="#" class="applicant text-unstyle">Applicant</a>
                    <a href="{{ route('employee-sign-up') }}" class="text-unstyle employee-text">Company</a>
                </div>
                <h2 class="text-center mb-4">Sign up as Applicant</h2>
                <div class="form-row d-flex">
                    <div class="col">
                        @error('fname')
                            <div class="form-group">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @enderror


                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                placeholder="Firstname*">
                        </div>
                        @error('lname')
                            <div class="form-group">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                placeholder="Last Name*">
                        </div>
                        @error('email')
                            <div class="form-group">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email*">
                        </div>
                    </div>
                    <div class="col">
                        @error('birthdate')
                            <div class="form-group">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="password">Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" id="birthdate">
                        </div>
                        @error('password')
                            <div class="form-group">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password*">
                        </div>
                        @error('confirmPassword')
                            <div class="form-group">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                placeholder="Confirm Password*">
                        </div>
                    </div>
                </div>
                @error('gender')
                    <div class="form-group">
                        <p class="text-danger">Error! Something is wrong.</p>
                    </div>
                @enderror
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-black" type="radio" name="gender" id="male"
                            value="male">
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-black" type="radio" name="gender" id="female"
                            value="female">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-4">
                        <button type="submit" class="btn btn-block oval-button">Register</button>
                    </div>

                </div>


            </form>
        </div>
    </div>
@endsection
