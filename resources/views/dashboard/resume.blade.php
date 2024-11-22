@extends('components.components.layout')
@section('content')
    <div class="row px-4 w-100">
        <div class="col">
            <a class="btn bg-white rounded" href="{{ route('profile') }}">Go Back</a>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h3>Resume Submission Form</h3>
            </div>

            <?php $resume = json_decode($applicant->resume); ?>
            <div class="card-body">
                <form method="POST" action="{{ route('resume') }}">
                    @csrf
                    {{-- Hidden Fields --}}
                    <input type="hidden" value="{{ session('applicant')->id }}" name="id">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe"
                            value="{{ $resume->name }}">
                    </div>

                    <!-- Age Field -->
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" min="18"
                            max="100" value="{{ $resume->age }}">
                    </div>

                    <!-- Gender Field -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" value="{{ $resume->gender }}">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Gender Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email Address"
                            value="{{ $resume->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="number" placeholder="+6391123"
                            value="{{ $resume->contactNum }}">
                    </div>


                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="123 Main St, City, Country"> {{ $resume->address }}</textarea>
                    </div>

                    <!-- Educational Attainment Field -->
                    <div class="mb-3">
                        <label for="education" class="form-label">Educational Attainment</label>
                        <input type="text" class="form-control" id="education" name="education"
                            placeholder="Bachelor's Degree in Computer Science" value="{{ $resume->education }}">
                    </div>
                    {{-- Skills Fields --}}
                    <div class="mb-3">
                        <label for="education" class="form-label">Skills</label>

                        <div class="skill-tags-container" id="skillTagsContainer">
                            @isset($resume->skills)
                                @foreach (explode(',', $resume->skills) as $skills)
                                @endforeach
                            @endisset
                            <select name="skills" id="skillInput" class="form-control skill-input">
                                <option selected="none">None</option>
                                <option value="communication">Communication</option>
                                <option value="programming">Programming</option>
                                <option value="accounting">Accounting</option>
                            </select>
                        </div>
                    </div>

                    <!-- Work Experience Field -->
                    <div class="mb-3">
                        <label for="experience" class="form-label">Work Experience / Background</label>
                        <textarea class="form-control" id="experience" name="work" rows="4"
                            placeholder="Describe your previous work experience" required></textarea>
                    </div>

                    <!-- References Field -->
                    <div class="mb-3">
                        <label for="references" class="form-label">References</label>
                        <textarea class="form-control" id="references" name="references" rows="3"
                            placeholder="John Smith - jsmith@example.com - (123) 456-7890"></textarea>
                    </div>

                    <!-- Upload Resume -->
                    {{-- <div class="mb-4">
                        <label for="resume" class="form-label">Upload Resume (PDF, DOCX)</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx"
                            required>
                    </div> --}}

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Submit Resume</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const skillInput = document.getElementById('skillInput');
        const skillTagsContainer = document.getElementById('skillTagsContainer');

        // Array to store skills
        const skills = [];

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
            skills.push(skill);

            // Create a skill tag element
            const skillTag = document.createElement('div');
            skillTag.classList.add('skill-tag');
            skillTag.innerHTML = `
        ${skill}
        <i class="bi bi-x-circle" onclick="removeSkill('${skill}')"></i>
      `;

            // Append skill tag to container
            skillTagsContainer.insertBefore(skillTag, skillInput);
        }

        // Function to remove a skill
        function removeSkill(skill) {
            const index = skills.indexOf(skill);
            if (index > -1) {
                skills.splice(index, 1);
            }

            // Remove the skill tag from the DOM
            const skillTags = document.querySelectorAll('.skill-tag');
            skillTags.forEach(tag => {
                if (tag.textContent.trim() === skill) {
                    tag.remove();
                }
            });
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
