@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <style>
        .buttonback:hover {
            background-color: darkblue;
            text-decoration-color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="d-flex flex-column align-items-end justify-content-end z-50 bottom-0 start-0 position-fixed w-100">



        @error('location')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('salary_min')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @error('salary_max')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('age_min')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @error('age_max')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @error('arrangement')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @error('duration')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror


        @error('employer_id')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('email')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('employer_id')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('companyID')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('experience')
            <div class="alert alert-warning alert-dismissible fade show position-relative bg-danger mx-2 col-sm-4 text-bg-danger"
                role="alert">
                <i class="fa fa-exclamation-triangle me-1" aria-hidden="true"></i><strong>Error!</strong>
                {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

    </div>

    <button class="btn buttonback rounded-5 text-white px-3 py-2 d-flex align-items-center justify-content-start ms-3 mt-3"
        style="background-color: blue; transition: all 0.3s;"
        onclick="window.location.href = '{{ route('employer-dashboard') }}'">
        <i class="fa-solid fa-arrow-left" style="color: white; font-size: 1.2rem;"></i>
        <span class="ps-2">Go Back</span>
    </button>


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
                            <input type="number" name="age_min" class="inputDesign" placeholder="Min Age"
                                min="18" max="65">
                            -
                            <input type="number" class="inputDesign" name="age_max" placeholder="Max Age"
                                min="18" max="65">
                        </div>
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

                    <div class="col mb-3" id="additional_employment">
                        <label class="font-bold" for="">Internship Duration</label>

                        <input type="text" class="inputDesign" name="duration" placeholder="Employment Duration"
                            value="{{ old('duration') }}">
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


                    <div class="">
                        <!-- Input Field -->
                        <label for="" class="form-label fw-bold">Requirements</label>

                        <div class="input-group">
                            <input type="text" id="taskInput" class="form-control" placeholder="Add a new task"
                                aria-label="New Task">
                            <button class="btn btn-primary" type="button" onclick="addTask()">Add</button>
                        </div>
                        <!-- Task List -->
                        <ul class="list-group" id="taskList"></ul>
                    </div>

                    {{-- For Description --}}

                    <div class="mt-3">
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
    </script>
@endsection
