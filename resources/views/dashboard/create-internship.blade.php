@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="row px-4 w-100">
        <div class="col">
            <a class="btn bg-white rounded" href="{{ route('employer-dashboard') }}">Go Back</a>
        </div>
    </div>
    <div class="container-fluid p-4">


        <div class="row w-100">
            <div class="col-md-6 mx-auto bg-white rounded-5">
                <div class="p-5 bgColor">
                    <h1 class="fw-bold h2 text-center mb-5">Create Internship</h1>
                    <!--FORM-->
                    <form action="{{ route('create-internship') }}" method="post">
                        @csrf
                        <input type="text" hidden name="company" value="{{ session('employer')->company }}">
                        <input type="text" hidden name="employer_id" value="{{ session('employer')->id }}">
                        <input type="text" hidden name="companyID" value="{{ session('employer')->companyID }}">
                        <input type="text" hidden name="requirements" id="requirements">
                        <input type="text" hidden name="description" id="description">

                        <!--Salary-->
                        <div class="mb-3">
                            <input type="text" class="inputDesign" name="salary" placeholder="Salary">
                        </div>
                        <!--Location-->
                        <div class="col mb-3">
                            <input type="text" class="inputDesign" name="location" placeholder="Location">
                        </div>
                        <!--Min Educ Attainment Level-->
                        <div class="mb-3">
                            <input type="text" class="inputDesign" name="education"
                                placeholder="Minimum Educational Attainment Level">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="inputDesign" name="email"
                                placeholder="Minimum Educational Attainment Level">
                        </div>

                        <div class="col mb-3" id="additional_employment">
                            <label class="font-bold" for="">Employment Duration</label>

                            <input type="text" class="inputDesign" name="duration" placeholder="Employment Duration"
                                value="{{ old('duration') }}">
                        </div>
                        <!--Min Requirements-->

                        <div class="">
                            <!-- Input Field -->
                            <label for="" class="form-label fw-bold">Requirements</label>

                            <div class="mb-3 input-group">
                                <input type="text" id="taskInput" class="form-control" placeholder="Add a new task"
                                    aria-label="New Task">
                                <button class="btn btn-primary" type="button" onclick="addTask()">Add</button>
                            </div>
                            <!-- Task List -->
                            <ul class="list-group" id="taskList"></ul>
                        </div>

                        {{-- For Description --}}

                        <div class="mt-4">
                            <!-- Input Field -->
                            <label for="" class="form-label fw-bold">Job Description</label>

                            <div class="mb-3 input-group">
                                <input type="text" id="descriptionInput" class="form-control"
                                    placeholder="Add a new description" aria-label="New Description">
                                <button class="btn btn-primary" type="button" onclick="addDescription()">Add</button>
                            </div>
                            <!-- Task List -->
                            <ul class="list-group" id="descriptionList"></ul>
                        </div>




                        <div class="row">
                            <!--Create BTN-->
                            <div class="col-2"></div>
                            <button type="submit" class="button py-2 px-4 mt-3">Create</button>
                            <div class="col-2"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
