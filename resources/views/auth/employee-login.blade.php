@extends('components.components.layout')
@section('head')
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }



        /* .container {
                                                                                                                                        flex: 1;
                                                                                                                                        display: flex;
                                                                                                                                        justify-content: center;
                                                                                                                                        align-items: center;
                                                                                                                                    } */

        .left-side {
            flex-basis: 50%;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .right-side {
            flex-basis: 50%;
            display: flex;
            flex-direction: column;
            background-color: white;
            border-radius: 120px 0 0 120px;
            padding: 25px;
            justify-content: center;
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
            background-color: white;
            color: #3931AF;
            border: 2px solid #3931AF;
            border-radius: 15px;
            padding: 5px 10px;
            margin-left: 30px;
            text-decoration: none;
            font-weight: 600;
        }

        .applicant-text {
            color: white;
            margin-left: 5px;
            text-decoration: none;
            font-weight: 600;
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

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-side,
            .right-side {
                height: 50vh;
            }
        }
    </style>
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center">

        <div class="left-side">
            <img src="{{ asset('public_img/Social Media users.png') }}" alt="rocketship" class="img-fluid mb-3"
                style="max-width: 100%; height: auto;">
            <blockquote class="blockquote">
                <p class="mb-0 text-white">Find the talent that drives your success. The right employee is just a search
                    away.</p>
            </blockquote>
        </div>

        <div class="right-side">

            <div class="combined-oval">
                <a href="{{ route('login') }}" class="applicant-text">Applicant</a>
                <a href="#" class="employee">Employee</a>
            </div>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h2 class="text-center mb-4">Login as an Employer</h2>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your Password">
                </div>
                <div class="form-group form-check d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-block custom-btn">Login</button>

            </form>

        </div>


    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/functions.js') }}"></script>
@endsection
