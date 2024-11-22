@extends('components.components.layout')
@section('head')
    <style>
        #left-side {
            flex-basis: 50%;
            text-align: center;
            padding: 20px;
        }

        #right-side {
            flex-basis: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 120px 0 0 120px;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
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

        .employee {
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin-left: 30px;



        }

        .applicant-text {
            background-color: white;
            color: #3931AF;
            border: 2px solid #3931AF;
            border-radius: 15px;
            padding: 5px 10px;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;

        }

        .form-control {
            border: none;
            border-bottom: 2px solid #3931AF;
            border-radius: 0;
            box-shadow: none;
            padding: 5px 0;
        }

        .form-control:focus {
            outline: none;
            border-color: #3931AF;
        }

        .custom-btn {
            background-color: #3931AF;
            color: white;
            border: none;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex w-100 mt-5 mb-4">
        <div class="col" id="left-side">
            <img src="{{ asset('public_img/Social Media users.png') }}" alt="rocketship" class="img-fluid mb-3"
                style="max-width: 100%; height: auto;">
            <blockquote class="blockquote">
                <p class="mb-0 text-white">Find the talent that drives your success. The right employee is just a search
                    away.
                </p>
            </blockquote>
        </div>

        <form class="p-4 d-block bg-white" action="{{ route('login') }}" method="post" id="right-side">
            @csrf
            <div class="combined-oval">
                <a class="applicant-text" href="#">Applicant</a>
                <a class="employee" href="{{ route('employee-login') }}">Employee</a>
            </div>
            <div class="container">
                <h2 class="text-center mb-4">Login as an Applicant</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Enter your Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter your Password">
                </div>
                <div class="form-group form-check d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>
            </div>

            <button type="submit" class="btn btn-block custom-btn">Login</button>
            <p class="mt-3 text-center">Don't have an account? <a href="{{ route('sign-up') }}">Create Account</a></p>
        </form>
    </div>
@endsection
