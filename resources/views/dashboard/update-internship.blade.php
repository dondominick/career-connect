@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
                <a class="btn bg-white" href="{{ url()->previous() }}">Go Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mx-auto">
                <div class="p-5 bgColor">
                    <h1 class="fw-bold h2 text-center mb-5">Update Internship</h1>
                    <!--FORM-->
                    <form action="{{ route('update-internship', $internship->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <!--Salary-->
                        <div class="mb-3">
                            <input type="text" class="inputDesign" name="salary" placeholder="Salary"
                                value="{{ $internship->salary }}">
                        </div>
                        <!--Location-->
                        <div class="col mb-3">
                            <input type="text" class="inputDesign" name="location" placeholder="Location"
                                value="{{ $internship->location }}">
                        </div>
                        <!--Min Educ Attainment Level-->
                        <div class="mb-3">
                            <input type="text" class="inputDesign" id="lastName" name="education"
                                placeholder="Minimum Educational Attainment Level" value="{{ $internship->education }}">
                        </div>



                        <div class="row">
                            <!--Min Requirements-->
                            <div class="mb-3">
                                <input type="text" class="inputDesign" id="minRequirements"
                                    placeholder="Minimum Requirements" name="email" value="{{ $internship->email }}">
                            </div>
                        </div>


                        <div class="row">
                            <!--Create BTN-->
                            <div class="col-2"></div>
                            <button type="submit" class="col btns py-2 px-4 mt-3 text-dark">Update</button>
                            <div class="col-2"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
