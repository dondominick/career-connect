@extends('components.components.layout')
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <section class="hero align-items-center d-flex"
        style="background-image: url('{{ asset('public_img/background.png') }}')">
        <div class="container">
            <div class="text-section">
                <h1>Search, Apply, <br>Succeed.</h1>
                <p>Welcome to CareerConnect, your gateway <br>to seamless online job opportunities.</p>

                <br>
                <div class="search-container">
                    <form class="input-wrapper" action="{{ route('search', 'search') }}" class="input-group" method="get"
                        id="job-form">
                        <div class="input-group">
                            @csrf

                            <!-- PARA MUGANA ANG SEARCH BARS BAI BUTNGAN ATA NI SYA UG FORM PARA MAKASEARCH I THINK?? -->
                            <label for="job">What?</label>
                            <input type="text" id="job" placeholder="Enter Job Title or Keywords" name="job"
                                class="input-field">
                        </div>

                        <div class="input-group">
                            <label for="location">Where?</label>
                            <input type="text" id="location" placeholder="Enter city, or region" class="input-field"
                                name="location">
                        </div>
                    </form>

                    <button
                        onclick="document.getElementById('job-form').submit().onsubmit(function () {
                            document.getElementById('location-form').submit()
                        });"
                        class="search-button">SEARCH</button>
                </div>

                <br>
                <div class="popular-searches">
                    <h6>Popular Searches</h6>
                    <div class="search-buttons">
                        <button><i class="fa-solid fa-magnifying-glass"></i> IT & Tech Jobs</button>
                        <button><i class="fa-solid fa-magnifying-glass"></i> Healthcare Jobs</button>
                        <button><i class="fa-solid fa-magnifying-glass"></i> Virtual Assistant</button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="joblist bg-white align-items-center d-flex p-5">
        <div class="container">
            <div class="joblist-section">
                <h2>Recommended Job Listings</h2>
                <p>Explore our top job listings and the latest opportunities tailored just for you!</p>

                <div class="btn-group" role="group" aria-label="Toggle Buttons">
                    <button type="button" class="btn btn-outline-custom active" id="latestJobsBtn"
                        onclick="toggleActive('latestJobs')">Latest Jobs</button>
                    <button type="button" class="btn btn-outline-custom" id="topJobsBtn"
                        onclick="toggleActive('topJobs')">Top Jobs</button>
                </div>

                <!-- Card Slider for LATEST JOBS -->
                <div id="latestJobsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- CARDS FOR SLIDE 1,2,3 -->
                        <div class="carousel-item active">
                            <div class="row">
                                @isset($recommends)
                                    @foreach ($recommends as $listing)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="company-name">{{ $listing->company }}</span>
                                                    <span
                                                        class="job-date">{{ date_format($listing->created_at, 'D, d M') }}</span>
                                                    <button class="btn btn-bookmark"><i
                                                            class="fa-regular fa-bookmark"></i></button>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">{{ $listing->position }}</h4>
                                                    <p class="card-text">{{ $listing->company }}</p>
                                                    <p class="card-text">{{ $listing->location }} City {{ $listing->salary }}
                                                        per
                                                        month </p>
                                                    <button
                                                        onclick="window.location.href = '{{ route('view-listing', $listing->id) }}'"
                                                        class="btn btn-view-details">View Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset


                            </div>
                        </div>
                        <!-- LATEST JOBS CAROUSEL CARDS FOR 4,5,6 -->
                        <div class="carousel-item">
                            <div class="row">
                                @foreach ($listings as $listing)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <span class="company-name">{{ $listing->company }}</span>
                                                <span
                                                    class="job-date">{{ date_format($listing->created_at, 'D, d M') }}</span>
                                                <button class="btn btn-bookmark"><i
                                                        class="fa-regular fa-bookmark"></i></button>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $listing->position }}</h4>
                                                <p class="card-text">{{ $listing->companyName }}</p>
                                                <p class="card-text">{{ json_decode($listing->description)[0] }}</p>
                                                <button
                                                    onclick="window.location.href = '{{ route('view-listing', $listing->id) }}'"
                                                    class="btn btn-view-details">View Details</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- Carousel controls forda Latest Jobs -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#latestJobsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#latestJobsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- TOP JOBS CONTAINER CAROUSEL -->
                <div id="topJobsCarousel" class="carousel slide" data-bs-ride="carousel" style="display: none;">
                    <div class="carousel-inner">
                        <!-- CARDS FOR 1,2,3 TOP JOBS -->
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="company-name">Company for Top Jobs</span>
                                            <span class="job-date">date created</span>
                                            <button class="btn btn-bookmark"><i
                                                    class="fa-regular fa-bookmark"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Top Jobs</h4>
                                            <p class="card-text">Visual Designers and Co.</p>
                                            <p class="card-text">Davao City ₱30,000 - ₱45,000 per month (Design &
                                                Architecture)</p>
                                            <button class="btn btn-view-details">View Details</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="company-name">Company Name</span>
                                            <span class="job-date">date created</span>
                                            <button class="btn btn-bookmark"><i
                                                    class="fa-regular fa-bookmark"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Top Job 2</h4>
                                            <p class="card-text">Job Company</p>
                                            <p class="card-text">Job Description</p>
                                            <button class="btn btn-view-details">View Details</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="company-name">Company Name</span>
                                            <span class="job-date">date created</span>
                                            <button class="btn btn-bookmark"><i
                                                    class="fa-regular fa-bookmark"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Job Title 3</h4>
                                            <p class="card-text">Job Company</p>
                                            <p class="card-text">Job Description</p>
                                            <button class="btn btn-view-details">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SLIDES FOR 4,5,6 TOP JOBS -->
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="company-name">Company Name</span>
                                            <span class="job-date">date created</span>
                                            <button class="btn btn-bookmark"><i
                                                    class="fa-regular fa-bookmark"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Top Job 4</h4>
                                            <p class="card-text">Job Company</p>
                                            <p class="card-text">Job Description</p>
                                            <button class="btn btn-view-details">View Details</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="company-name">Company Name</span>
                                            <span class="job-date">date created</span>
                                            <button class="btn btn-bookmark"><i
                                                    class="fa-regular fa-bookmark"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Job Title 5</h4>
                                            <p class="card-text">Job Company</p>
                                            <p class="card-text">Job Description</p>
                                            <button class="btn btn-view-details">View Details</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="company-name">Company Name</span>
                                            <span class="job-date">date created</span>
                                            <button class="btn btn-bookmark"><i
                                                    class="fa-regular fa-bookmark"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Job Title 6</h4>
                                            <p class="card-text">Job Company</p>
                                            <p class="card-text">Job Description</p>
                                            <button class="btn btn-view-details">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel controls para sa Top Jobs -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#topJobsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#topJobsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div> <!--DIV ni sa joblist section unya ang sa ubos kay DIV sa container-->
        </div>
    </section>

    <section class="activityfeed align-items-center d-flex">
        <div class="container" id="activityfeed">
            <div class="activityfeed-section">
                <h2 style="color: white; padding: 20px; margin-left: -2%;">Activity Feed</h2>
                <p style="color: white">Stay updated with your latest job applications and notifications, all in one place!
                </p>

                <div class="row">
                    <!-- Accepted Application -->
                    @isset($notifications)
                        @foreach ($notifications as $notif)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    @if ($notif->status == 'delete-listing')
                                        <div class="card-icon bg-dark">
                                            <i class="fa fa-ban"></i>
                                        </div>
                                    @endif
                                    @if ($notif->status == 'rejected')
                                        <div class="card-icon bg-dark">
                                            <i class="fa fa-ban"></i>
                                        </div>
                                    @endif
                                    @if ($notif->status == 'new-application')
                                        <div class="card-icon bg-primary">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                    @endif
                                    @if ($notif->status == 'successful')
                                        <div class="card-icon bg-success">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <p>{{ $notif->title }}</p>
                                        <small class="text-muted">3 hours ago</small>
                                        <button class="btn btn-outline-primary btn-sm mt-2"
                                            onclick="window.location.href = '{{ route('notification') }}'">View
                                            Details</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset



                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-icon bg-success">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="card-body">
                                <p>Your application for [Job Title] at [Company Name] has been accepted.</p>
                                <small class="text-muted">2 hours ago</small>
                                <button class="btn btn-outline-primary btn-sm mt-2">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Review Application -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-icon bg-warning">
                                <i class="fa fa-hourglass-half"></i>
                            </div>
                            <div class="card-body">
                                <p>Your application for [Job Title] at [Company Name] is still under review.</p>
                                <small class="text-muted">1 day ago</small>
                                <button class="btn btn-outline-primary btn-sm mt-2">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Closed Application -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-icon bg-dark">
                                <i class="fa fa-ban"></i>
                            </div>
                            <div class="card-body">
                                <p>The job listing for [Job Title] at [Company Name] has been closed.</p>
                                <small class="text-muted">5 days ago</small>
                                <button class="btn btn-outline-primary btn-sm mt-2">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- New Application (1) -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-icon bg-primary">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="card-body">
                                <p>You have a new application for [Job Title] from [Applicant's Name].</p>
                                <small class="text-muted">5 hours ago</small>
                                <button class="btn btn-outline-dark btn-sm mt-2">View Application</button>
                            </div>
                        </div>
                    </div>

                    <!-- New Application (2) -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-icon bg-primary">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="card-body">
                                <p>You have a new application for [Job Title] from [Applicant's Name].</p>
                                <small class="text-muted">1 day ago</small>
                                <button class="btn btn-outline-dark btn-sm mt-2">View Application</button>
                            </div>
                        </div>
                    </div>

                    <!-- New Application (3) -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-icon bg-primary">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="card-body">
                                <p>You have a new application for [Job Title] from [Applicant's Name].</p>
                                <small class="text-muted">3 days ago</small>
                                <button class="btn btn-outline-dark btn-sm mt-2">View Application</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('js/home.js') }}"></script>
    @endsection
