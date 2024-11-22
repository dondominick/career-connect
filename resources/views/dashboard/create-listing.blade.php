@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        #details_list li {}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="row mb-2">
            <div class="col">
                <a class="btn bg-white rounded" href="{{ route('employer-dashboard') }}">Go Back</a>
            </div>
        </div>

        <div class="row">
            <div class="p-5 col-6 mx-auto bgColor">
                <h1 class="fw-bold h2 text-center mb-5">Create Listing</h1>
                <!--FORM-->
                <form action="{{ route('create-listing') }}" method="post" id="create-form">
                    @csrf
                    {{-- hiddden fields --}}
                    <input type="text" name="employer_id" hidden value="{{ session('employer')->id }}">
                    <input type="text" name="company" hidden value="{{ session('employer')->company }}">
                    <input type="text" name="companyID" hidden value="{{ session('employer')->companyID }}">
                    <input type="text" hidden name="requirements" id="requirements">
                    <input type="text" hidden name="description" id="description">


                    <!--Postion-->
                    <div class="col mb-3">
                        <label class="font-bold" for="">Position</label>
                        <input type="text" class="inputDesign" name="position" placeholder="Position"
                            value="{{ old('position') }}">
                    </div>
                    <!--Salary-->
                    <div class="mb-3">
                        <label class="fw-bold">Salary Range:</label>
                        <div class="d-flex justify-content-between gap-3">
                            <input class="col inputDesign px-2 py-1" type="number" name="salary_min"
                                placeholder="Min Salary" min="0" step="1000" value="{{ old('salary_min') }}">
                            -
                            <input class="col inputDesign px-2 py-1" type="number" name="salary_max"
                                placeholder="Max Salary" min="0" step="1000" value="{{ old('salary_max') }}">
                        </div>

                    </div>
                    <!--Location-->
                    <div class="col mb-3">
                        <label class="font-bold" for="">Location</label>

                        <input type="text" class="inputDesign" name="location" placeholder="Location"
                            value="{{ old('location') }}">
                    </div>
                    {{-- Email --}}
                    <div class="col mb-3">
                        <label class="font-bold" for="">Email</label>

                        <input type="text" class="inputDesign" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                    </div>
                    {{-- Work Arrangement --}}
                    <div class="col mb-3">
                        <label class="font-bold" for="">Work Arrangement</label>
                        <select name="arrangement" id="" class="mt-1 form-select">
                            <option selected="onsite">Onsite</option>
                            <option value="wfh">Work from Home</option>
                            <option value="hybrid">Hybird</option>
                        </select>

                    </div>
                    {{-- Age Range --}}

                    <div class="col mb-3">
                        <label class="fw-bold">Preferred Age Range:</label>
                        <div class="d-flex justify-content-between gap-3">
                            <input type="number" name="age_min" class="inputDesign" placeholder="Min Age" min="18"
                                max="65" required>
                            -
                            <input type="number" class="inputDesign" name="age_max" placeholder="Max Age" min="18"
                                max="65" required>
                        </div>
                    </div>

                    {{-- Employment Type --}}

                    <div class="col mb-3" id="types">
                        <label class="font-bold" for="">Employment Type</label>
                        <select name="type" id="type" class="mt-1 form-select" onchange="addInfo()">
                            <option selected="full-time">Full Time</option>
                            <option value="part-time">Part-Time</option>
                            <option value="freelance">Freelance</option>
                            <option value="temporary">Temporary</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>
                    {{-- Additional Info For Employment Type --}}
                    <div class="col mb-3 d-none" id="additional_employment">
                        <label class="font-bold" for="">Employment Duration</label>

                        <input type="text" class="inputDesign" name="duration" placeholder="Employment Duration"
                            value="{{ old('duration') }}">
                    </div>
                    <div class="col mb-3 d-none" id="additional_employment_hours">
                        <label class="font-bold" for="">Work Hours</label>

                        <input type="text" class="inputDesign" name="hours" placeholder="Work Hours"
                            value="{{ old('hours') }}">
                    </div>
                    <!--Min Educ Attainment Level-->
                    <div class="mb-3">
                        <label class="font-bold" for="">Mininum Education Level</label>
                        <select id="" class="mt-1 form-select" name="education">
                            <option selected="none">No Minimum</option>
                            <option value="highschool">High School Diploma</option>
                            <option value="undergraduate">College Undergraduate</option>
                            <option value="bachelor">Bachelor's Degree</option>
                            <option value="masters">Master's Degree</option>
                            <option value="phd">Ph.D.</option>
                        </select>
                    </div>

                    {{-- Experience Level --}}
                    <div class="mb-3">
                        <label class="font-bold" for="">Experience Level</label>
                        <select id="" class="form-select" name="experience">
                            <option selected="entry">Entry Level</option>
                            <option value="mid">Mid Level</option>
                            <option value="senior">Senior Level</option>
                            <option value="director">Director Level</option>
                            <option value="executive">Executive</option>
                        </select>
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

                    {{-- Submit --}}
                    <div class="row">
                        <!--Create BTN-->
                        <div class="col-2"></div>
                        <button type="submit" class="col button py-2 px-4 mt-3 text-dark">Create</button>
                        <div class="col-2"></div>
                    </div>
                </form>

                <button class="btn" onclick="test()">Get All Task</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const taskInput = document.getElementById('taskInput');
        const taskList = document.getElementById('taskList');


        // Function to add a new task
        function addTask() {
            const taskText = taskInput.value.trim();
            if (taskText === '') return;

            // Create list item
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
        <span class="task-text">${taskText}</span>
        <div>
            <button class="btn btn-danger btn-sm" onclick="deleteTask(this)">Delete</button>
        </div>
    `;

            taskList.appendChild(li);
            taskInput.value = '';
        }

        // Function to delete a task
        function deleteTask(button) {
            const li = button.closest('li');
            li.remove();
        }

        // Add task on pressing Enter
        taskInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addTask();
            }
        });


        function getAllTask() {
            let array = [];
            let task = $("#taskInput").val();
            let tasks = $(".task-text");
            tasks = Object.values(tasks);

            tasks.forEach(element => {
                if (typeof element.textContent == "string") {
                    array.push(element.textContent)
                }
            });

            if (task.trim() === "") {
                return JSON.stringify(array);
            }
            array.push(task)


            return JSON.stringify(array);

        }

        // For description

        const descriptionInput = document.getElementById('descriptionInput');
        const descriptionList = document.getElementById('descriptionList');


        // Function to add a new task
        function addDescription() {
            const descText = descriptionInput.value.trim();
            if (descText === '') return;

            // Create list item
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
        <span class="desc-text">${descText}</span>
        <div>
            <button class="btn btn-danger btn-sm" onclick="deleteTask(this)">Delete</button>
        </div>
    `;

            descriptionList.appendChild(li);
            descriptionInput.value = '';
        }

        // Function to delete a task
        function deleteTask(button) {
            const li = button.closest('li');
            li.remove();
        }

        // Add task on pressing Enter
        descriptionInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addDescription();
            }
        });


        function getAllDesc() {
            let array = [];
            let task = $("#descriptionInput").val();
            let tasks = $(".desc-text");
            tasks = Object.values(tasks);

            tasks.forEach(element => {
                if (typeof element.textContent == "string") {
                    array.push(element.textContent)
                }
            });


            if (task.trim() == "") {
                return JSON.stringify(array);
            }
            array.push(task)
            return JSON.stringify(array);
        }

        function test() {
            // Get all the text from the list for the requirements including in the input fields
            $('#requirements').val(getAllTask())
            // Get all the text from the list for the description including in the input field
            $('#description').val(getAllDesc());

            console.log($('#requirements').val())
            console.log($('#description').val());
        }

        $('#create-form').onsubmit(function(e) {
            // Get all the text from the list for the requirements including in the input fields
            $('#requirements').val(getAllTask())
            // Get all the text from the list for the description including in the input field
            $('#description').val(getAllDesc());

            console.log($('#requirements').val())
            console.log($('#description').val());

        });


        // Addtional Info for Employment Type

        function addInfo() {
            const type = $('#type').val();
            const additional = $('#additional_employment');
            const hours = $('#additional_employment_hours');


            if (type == "contract" || type == "temporary") {
                additional.removeClass('d-none');
                hours.addClass('d-none');


            } else if (type == "part-time") {
                hours.removeClass('d-none');
                additional.addClass('d-none');


            } else {
                additional.addClass('d-none');
                hours.addClass('d-none');

            }


        }
    </script>
@endsection
