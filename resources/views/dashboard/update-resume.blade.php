@extends('components.components.layout')
@section('head')
    <style>
        .skill-tag {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('content')
    <div class="row px-4 w-100 my-5">
        <div class="col">
            <a class="btn bg-white rounded" href="{{ route('profile') }}">Go Back</a>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h3>Resume Update Form</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('resume') }}" onsubmit="getAll()">
                    @csrf
                    @method('patch')
                    {{-- Hidden Fields --}}
                    <input type="hidden" value="{{ session('applicant')->id }}" name="id">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe"
                            value="{{ $resume->name }}">
                        @error('name')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Age Field -->
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" min="18"
                            max="100" value="{{ $resume->age }}">
                        @error('age')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Gender Field -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option selected="{{ $resume->gender }}">{{ $resume->gender }}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('gender')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email Address"
                            value="{{ $resume->email }}">
                        @error('email')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact_no" placeholder="+6391123"
                            value="{{ $resume->contact_no }}">
                        @error('contact_no')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="123 Main St, City, Country"> {{ $resume->address }}</textarea>
                        @error('address')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Educational Attainment Field -->
                    <div class="mb-3">
                        <label for="education" class="form-label">Highest Educational Attainment</label>
                        <select name="education" id="education" class="form-control" onchange="checkIfUndergrad()">
                            <option selected>{{ $resume->education }}</option>
                            <option value="elementary">Elementary Graduate</option>
                            <option value="highschool">Highschool Graduate</option>
                            <option value="undergraduate">Undergraduate</option>
                            <option value="bachelor">College Graduate</option>
                            <option value="masters">Masters</option>
                            <option value="phd">PH.D</option>

                        </select>
                        @error('education')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- Additional Info for Undergraduate Studies --}}

                    <div class="mb-3 d-none" id="undergrad">
                        <label for="" class="form-label">Bachelor's Degree</label>
                        <select class="form-select form-select-lg" name="degree" id="">
                            <option selected>{{ $resume->undergrad }}</option>
                            <option value="BE">Bachelor of Arts in English</option>
                            <option value="BPS">Bachelor of Arts in Political Science</option>
                            <option value="BGD">Bachelor of Arts in Graphic Design</option>
                            <option value="BIA">Bachelor of Arts in Interior Arts</option>
                            <option value="BS">Bachelor of Arts in Sociology</option>
                            <option value="BSCS">Bachelor of Science in Computer Science</option>
                            <option value="BSIT">Bachelor of Science in Information Technology</option>
                            <option value="BSP">Bachelor of Science in Physics</option>
                            <option value="BSIS">Bachelor of Science in Information Systems</option>
                            <option value="BSC">Bachelor of Science in Chemistry</option>
                            <option value="BSDS">Bachelor of Science in Data Science</option>
                            <option value="BSME">Bachelor of Science in Mechanical Engineering</option>
                            <option value="BSCEng">Bachelor of Science in Civil Engineering</option>
                            <option value="BSR">Bachelor of Science in Robotics</option>
                            <option value="BSChemE">Bachelor of Science in Chemical Engineering</option>
                            <option value="BSCompE">Bachelor of Science in Computer Engineering</option>
                            <option value="BSEE">Bachelor of Science in Electrical Engineering</option>
                            <option value="BSBA">Bachelor of Science in Business Administration</option>
                            <option value="BSTM">Bachelor of Science in Tourism Management</option>
                            <option value="BSE">Bachelor of Science in Entreprenuership</option>
                            <option value="BSSE">Bachelor of Science in Secondary Education</option>
                            <option value="BSA">Bachelor of Science in Accountancy</option>
                        </select>
                        @error('degree')
                            <small class="text-danger alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    {{-- SCRIPT FOR UNDERGRADUATE --}}

                    <script>
                        function checkIfUndergrad() {
                            const educ = document.getElementById('education');
                            const degree = document.getElementById('undergrad');
                            if (educ.value == "bachelor" || educ.value == "undergraduate") {
                                degree.classList.remove('d-none');

                            } else {
                                degree.classList.add('d-none');

                            }
                        }
                    </script>

                    {{-- END OF CODE --}}

                    <div class="mb-3 d-flex flex-column">
                        @stack('education')
                    </div>
                    {{-- Skills Fields --}}
                    <div class="mb-3">
                        <label for="education" class="form-label">Skills</label>


                        <div class="skill-tags-container" id="skillTagsContainer">
                            @isset($resume->skills)
                                @php
                                    $skills = $resume->skills;
                                @endphp
                                <script>
                                    let text = "{{ $skills }}";

                                    let skills = text.split(',');
                                    if (skills.constructor != Array) {
                                        skills = [text];
                                        console.log('working');
                                    }
                                    console.log(skills);

                                    function addSkill(skills) {
                                        skills.forEach(skill => {
                                            const skillTag = document.createElement('div');
                                            skillTag.classList.add('skill-tag');
                                            skillTag.classList = "my-1 fs-5"
                                            skillTag.innerHTML = `
                                                ${skill}
                                                <i class="bi bi-x-circle" onclick="removeSkill('${skill}')"></i>
                                            `;

                                            // Append skill tag to container
                                            skillTagsContainer.appendChild(skillTag);

                                        });
                                    }
                                    addSkill(skills)
                                </script>
                            @endisset
                        </div>
                        <textarea name="skills" id="skills" hidden cols="30" rows="10"></textarea>
                        <select name="skills" id="skillInput" class="form-control skill-input">
                            <option selected="none">None</option>
                            <option value="communication">Communication</option>
                            <option value="programming">Programming</option>
                            <option value="accounting">Accounting</option>
                            <option value="project-management">Project Management</option>
                            <option value="verbal">Verbal Communication</option>
                            <option value="written">Written Communication</option>
                            <option value="public-speaking">Public Speaking</option>
                            <option value="team-management">Team Management</option>
                            <option value="conflict-resolution">Conflict Resolution</option>
                            <option value="decision-making">Decision Making</option>
                            <option value="mentoring">Mentoring and Coaching</option>
                            <option value="critical">Critical Thinking</option>
                            <option value="creativity">Creativity</option>
                            <option value="multitasking">Multitasking</option>
                            <option value="emotional">Emotional Intelligence</option>
                            <option value="customer">Customer Support</option>
                            <option value="negotiation">Negotiation Skills</option>
                            <option value="service">Service Orientation</option>

                        </select>
                    </div>

                    {{-- Work Experience Fields --}}

                    <div class="mb-3">
                        <label for="form-label">Work Experience</label>

                    </div>

                    @php
                        $work = json_decode($resume->work);
                    @endphp

                    @if ($work != null)
                        @foreach ($work as $e)
                            <script>
                                const e = JSON.parse({{ $e }})
                                updateWork(e.position, e.company, e.duration);
                            </script>
                        @endforeach
                    @endif


                    {{ old('skills') }}
                    {{ old('references') }}
                    {{ old('educational_background') }}
                    <textarea name="work_experience" id="work_experience" cols="30" rows="10" hidden></textarea>
                    <div class="mb-3 d-flex flex-column gap-3 " id="work-box">

                    </div>


                    <div class="mb-3">
                        <button class="btn button" type="button" data-bs-target="#workModal" data-bs-toggle="modal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <label for="form-label">Add Work Experience</label>
                    </div>





                    <div class="modal fade" id="workModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="form-label">
                                            Job Position
                                        </label>
                                        <input type="text" class="form-control" id="resume-job-position">
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">
                                            Company
                                        </label>
                                        <input type="text" class="form-control" id="resume-job-company">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Job Duration
                                        </label>
                                        <input type="
                                        " class="form-control"
                                            id="resume-job-duration">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="retrieve_work()"
                                        data-bs-dismiss="modal">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- END OF WORK CODE MODAL --}}

                    {{-- START OF EDUCATION MODAL CODE --}}



                    <div class="mb-3">
                        <label for="form-label">Educational Background</label>

                    </div>

                    <textarea name="educational_background" id="educational_background" cols="30" rows="10" hidden></textarea>


                    <div class="my-3">
                        <button class="btn button" type="button" data-bs-target="#educationModal"
                            data-bs-toggle="modal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <label for="form-label">Add Educational Background</label>
                    </div>

                    <div class="mb-3 d-flex flex-column gap-3 " id="education-box">

                    </div>
                    <!-- Education Modal -->
                    <div class="modal fade" id="educationModal" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Educational Background</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Title Graduated With
                                        </label>
                                        <input type="text" class="form-control" id="resume-education-title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            School Name
                                        </label>
                                        <input type="text" class="form-control" id="resume-education-school">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Year
                                        </label>
                                        <input type="text" class="form-control" id="resume-education-year">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        onclick="retrieveEducation()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- START OF REFERENCE CODE  --}}




                    <!-- References Field -->
                    <div class="mb-3">
                        <label for="references" class="form-label">References</label>
                    </div>

                    <textarea class="form-control" id="references" name="references" rows="10" cols="10" hidden></textarea>

                    <div class="mb-3 d-flex flex-column gap-3 " id="reference-box">

                    </div>


                    <div class="my-3">
                        <button class="btn button" type="button" data-bs-target="#referenceModal"
                            data-bs-toggle="modal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <label for="form-label">Add References</label>
                    </div>


                    <div class="modal fade" id="referenceModal" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">References</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Full Name
                                        </label>
                                        <input type="text" class="form-control" id="resume-reference-name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Position
                                        </label>
                                        <input type="text" class="form-control" id="resume-reference-position">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Company Name
                                        </label>
                                        <input type="text" class="form-control" id="resume-reference-company">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Email
                                        </label>
                                        <input type="text" class="form-control" id="resume-reference-email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Phone Number
                                        </label>
                                        <input type="text" class="form-control" id="resume-reference-number">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        onclick="retrieveReference()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SCRIPT FOR MODAL REFERENCE, EDUCATION AND WORK --}}


                    <script>
                        // ARRAY FOR STORING THE SAVE DATA

                        let work_experience = [];
                        let educational_background = [];
                        let references = [];
                        // FOR OBJECT MAKING THE DATA INTO A JSON / OBJECT FORMAT =>
                        // MAKING THE CODE MORE CLEANIER AND EASIER TO FUCKING READ

                        function Work(position, company, duration) {
                            this.position = position;
                            this.company = company;
                            this.duration = duration;
                        }

                        function Education(title, school, year) {
                            this.school = school;
                            this.title = title;
                            this.year = year;
                        }

                        function References(name, position, company, email, contact_no) {
                            this.name = name;
                            this.position = position;
                            this.company = company;
                            this.email = email;
                            this.contact_no = contact_no;
                        }

                        // UPDATE RESUME

                        function updateWork(position, company, duration) {
                            const work = new Work(position, company, duration);

                            work_experience.push(JSON.stringify(work));
                            createWork(work); // PASTE THE DATA AND TURN IT INTO A MORE READABLE DATA
                        }

                        function updateEducation(name, school, year) {
                            const education = new Education(name, school, year);


                            if (educational_background.length > 3) {
                                return console.log('error');
                            }
                            educational_background.push(JSON.stringify(education));
                            createEducation(education);
                        }

                        function updateReference(name, position, company, email, number) {
                            const reference = new References(name, position, company, email, number);



                            references.push(JSON.stringify(reference));
                            createReference(reference);

                        }
                        // RETRIEVE DATA FROM MODALS

                        function retrieve_work() {
                            const position = document.getElementById('resume-job-position');
                            const company = document.getElementById('resume-job-company');
                            const duration = document.getElementById('resume-job-duration');
                            const work = new Work(position.value, company.value, duration.value);

                            position.value = "";
                            company.value = "";
                            duration.value = "";
                            work.value = "";

                            work_experience.push(JSON.stringify(work));
                            createWork(work); // PASTE THE DATA AND TURN IT INTO A MORE READABLE DATA
                        }

                        function retrieveEducation() {
                            const name = document.getElementById('resume-education-title');
                            const school = document.getElementById('resume-education-school');
                            const year = document.getElementById('resume-education-year');



                            const education = new Education(name.value, school.value, year.value);
                            name.value = "";
                            school.value = "";
                            year.value = "";

                            if (educational_background.length > 3) {
                                return console.log('error');
                            }
                            educational_background.push(JSON.stringify(education));
                            createEducation(education);

                        }

                        function retrieveReference() {
                            const name = document.getElementById('resume-reference-name');
                            const company = document.getElementById('resume-reference-company');
                            const position = document.getElementById('resume-reference-position');
                            const email = document.getElementById('resume-reference-email');
                            const number = document.getElementById('resume-reference-number');

                            const reference = new References(name.value, position.value, company.value, email.value, number.value);


                            name.value = "";
                            company.value = "";
                            position.value = "";
                            email.value = "";
                            number.value = "";

                            references.push(JSON.stringify(reference));
                            createReference(reference);
                        }


                        // USE THE DATA FETCHED AND PASTE IT INTO THE RESUME

                        function createWork(obj) {
                            const container = document.getElementById('work-box');
                            const work = document.createElement('div');
                            work.classList = "card shadow-4 p-1";

                            work.innerHTML = `
                                <div class="card-title fw-bold fs-4 resume-job-position">
                                ${obj.position}
                                    </div>
                                <div class="card-subtitle">
                                    <span class="text-secondary  resume-job-company">
                                ${obj.company} |
                                    </span>
                                    <span class="text-secondary resume-education-duration">
                                ${obj.duration}
                                    </span>
                                </div>
                            `;

                            container.appendChild(work);
                            console.log('working');
                        }

                        function createEducation(obj) {
                            const container = document.getElementById('education-box');
                            const education = document.createElement('div');
                            education.classList = "card shadow-4 p-1";

                            education.innerHTML = `
                                <div class="card-title fw-bold fs-4 resume-education-title">
                                ${obj.title}
                                    </div>
                                <div class="card-subtitle">
                                    <span class="text-secondary  resume-education-school">
                                ${obj.school} |
                                    </span>
                                    <span class="text-secondary resume-education-year">
                                ${obj.year}
                                    </span>
                                </div>
                            `;

                            container.appendChild(education);
                            console.log('working');
                        }


                        function createReference(obj) {
                            const container = document.getElementById('reference-box');
                            const reference = document.createElement('div');
                            reference.classList = "card shadow-4 p-1";

                            reference.innerHTML = `
                                <div class="card-title fw-bold fs-4">
                                ${obj.name}
                                    </div>
                                <div class="card-subtitle">
                                    <span class="text-secondary">
                                ${obj.company} |
                                    </span>
                                    <span class="text-secondary">
                                ${obj.position}
                                    </span>

                                </div>
                                <div class="card-subtitle">
                                <span class="fw-bold">
                                    Phone: 
                                </span>                                ${obj.contact_no}
                                    <br>
                                    <span class="fw-bold">
                                        Email: 
                                    </span>
                                                                            ${obj.email}

                                </div>
                            `;

                            container.appendChild(reference);
                            console.log('working');
                        }
                        // RETRIEVE ALL THE DATA AND PASS IT INTO THE REQUEST FROM

                        function getAll() {
                            const education = document.getElementById('educational_background');
                            const work = document.getElementById('work_experience');
                            const ref = document.getElementById('references');
                            const skill = document.getElementById('skills');
                            education.value = educational_background;
                            work.value = work_experience;
                            ref.value = references;
                            skill.value = skills;

                            console.log(education.value);
                            console.log(work.value);
                            console.log(ref.value);
                            console.log(skill.value);
                            console.log('data passed');
                        }
                    </script>
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Submit Resume</button>
                    </div>
                </form>

                <button class="btn" onclick="getAll()" type="submit">
                    TEST
                </button>
            </div>
        </div>
    </div>

    {{-- Work /  Experience Modal --}}


    {{-- Reference Modal --}}
@endsection

@section('scripts')
    <script>
        const skillInput = document.getElementById('skillInput');
        const skillTagsContainer = document.getElementById('skillTagsContainer');

        // Array to store skills

        // Add a skill when user presses Enter or Comma
        skillInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault();
                const skill = skillInput.value.trim();
                if (skill && !skills.includes(skill)) {
                    addSkill(skill);
                }
                skillInput.value = '';
            }
        });

        // Function to add a skill
        function addSkill(skill) {
            const skillTag = document.createElement('div');
            skillTag.classList.add('skill-tag');
            skillTag.classList = "my-1 fs-5"
            skillTag.innerHTML = `
                                                ${skill}
                                                <i class="bi bi-x-circle" onclick="removeSkill('${skill}')"></i>
                                            `;

            // Append skill tag to container
            skillTagsContainer.appendChild(skillTag);
            skills.push(skill);
        }

        // Function to remove a skill
        function removeSkill(skill) {
            let i = 0;
            skills.forEach(element => {
                if (element == skill) {
                    skills.splice(i);
                }
                i++;

            });
            skillTagsContainer.innerHTML = "";
            addSkill(skills);


        }

        function retrieveAllSkills() {
            //    const skill = $('.skill-tag').val();
            const skill = $('#skillInput');
            skills.push(skill.val());
            console.log(skills)
        }

        function formSubmit() {
            const skill = $('#skillInput');
            skills.push(skill.val());
            skill.val(skills.toString());

        }
    </script>
@endsection
