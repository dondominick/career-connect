@extends('components.components.layout')
@section('head')

    <head>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F5F5F5;
            margin: 0;
            padding: 0;
        }

        #left-side {
            flex-basis: 50%;
            text-align: center;
            padding: 40px;
            background-color: #3931AF;
            color: white;
        }

        #right-side {
            flex-basis: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #3931AF;
            border-radius: 0;
            box-shadow: none;
            padding: 10px 5px;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-bottom: 2px solid #5A55CA;
            background-color: #F7F7F7;
        }

        .custom-btn {
            background-color: #3931AF;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .custom-btn:hover {
            background-color: #5A55CA;
        }

        .form-check-label {
            font-size: 14px;
        }

        a {
            color: #3931AF;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #5A55CA;
            text-decoration: underline;
        }

        .header-text {
            font-weight: 700;
            font-size: 28px;
            color: #3931AF;
        }

        .description {
            font-size: 16px;
            color: white;
            margin-top: 10px;
            line-height: 1.5;
        }

        blockquote {
            font-size: 16px;
            font-style: italic;
            color: white;
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex w-100 mt-5 mb-4">
        <!-- Left Section -->
        <div class="col" id="left-side">
            <img src="{{ asset('public_img/Social Media users.png') }}" alt="Career Connect Illustration"
                class="img-fluid mb-3" style="max-width: 100%; height: auto;">
            <h3 class="header-text">Find the talent that drives your success</h3>
            <p class="description">The right employee is just a search away.</p>
        </div>

        <!-- Right Section -->
        <form class="p-5 d-block bg-white" action="{{ route('login') }}" method="post" id="right-side">
            @csrf
            <div class="container login-form">
                <h2 class="text-center mb-4">Login to Career Connect</h2>
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Enter your Username">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter your Password">
                </div>
                <div class="form-group form-check d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-block custom-btn">Login</button>
                <p class="mt-3 text-center">Don't have an account? <a href="{{ route('sign-up') }}">Create Account</a></p>
            </div>
        </form>
    </div>
@endsection
