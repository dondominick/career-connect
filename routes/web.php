<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\FirstAuth;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Employer;
use App\Models\Internship;
use App\Models\Listing;
use App\Models\Notification;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// MIDDLEWARE ONLY ALLOWS AUTHENTICATED USERS FROM ENTERING CERTAIN PARTS OF THE WEBSITE
// auth -> basic built-in authenticated middleware of laravel
Route::middleware(['auth'])->group(function () {


    // GENERAL AUTHENTICATED USERS ROUTES
    Route::get('/home', [ListingController::class, 'recommendUsers'])->name('home');
    Route::view("/profile", 'dashboard.profile')->name('profile');
    Route::patch('/profile', [UserController::class, 'update']);
    Route::get('/profile/notification', [NotificationController::class, 'displayNotifications'])->name('notification');

    // 
    // 
    // APPLICANT RELATED ROUTES
    // 
    Route::post('/resume', [ResumeController::class, 'create']);
    Route::get('/resume', [ApplicantController::class, 'checkResume'])->name('resume');

    // POSTS
    Route::post('internships/{id}', [ApplicationController::class, 'checkResume']);
    Route::post('listings/{id}', [ApplicationController::class, 'checkResume']);
    // PATCH

    // 
    // 
    // EMPLOYER RELATED ROUTES
    // 
    Route::view("/profile/employer-dashboard/create-listing", "dashboard.create-listing")->name("create-listing");
    Route::view("/profile/employer-dashboard/create-internship", "dashboard.create-internship")->name("create-internship");

    // GET / RETRIEVE DATA FROM THE DATABASE
    Route::get("/profile/employer-dashboard/listing-details/{id}", [EmployerController::class, 'displayListing'])->name("view-details");
    Route::get("/profile/employer-dashboard/update-listing/{id}", [ListingController::class, 'update'])->name("update-listing");
    Route::get("/profile/employer-dashboard/update-internship/{id}", [EmployerController::class, 'updateListing'])->name("update-internship");
    Route::get("/profile/employer-dashboard/internship-details/{id}", [EmployerController::class, 'displayInternship'])->name("internship-details");
    Route::get('/profile/employer-dashboard', [EmployerController::class, 'displayListings'])->name('employer-dashboard');
    Route::get('/profile/employer-dashboard/listing-details/{id}/listings', [ListingController::class, 'statusListing'])->name('status-listing');
    Route::get('/profile/employer-dashboard/internship-details/{id}/internships', [InternshipController::class, 'statusInternship'])->name('status-intern');

    // POSTS
    Route::post("/profile/employer-dashboard/create-listing", [ListingController::class, 'create']);
    Route::post('/profile/employer-dashboard/create-internship', [InternshipController::class, 'create']);
    Route::post('/profile/employer-dashboard/status', [EmployerController::class, 'statusCheck'])->name('statusCheck');
    Route::patch('/profile/employer-dashboard/internship-details/{id}', [ApplicationController::class, 'updateApplication']);
    Route::patch('/profile/employer-dashboard/listing-details/{id}', [ApplicationController::class, 'updateApplication']);

    // UPDATES
    Route::patch("/profile/employer-dashboard/update-listing/{id}", [ListingController::class, 'updateListing']);
    Route::patch("/profile/employer-dashboard/update-internship/{id}", [InternshipController::class, 'update']);

    // DELETES
    Route::delete("/profile/employer-dashboard/listings", [ListingController::class, 'delete'])->name('delete-listing');
    Route::delete("/profile/employer-dashboard/internships", [InternshipController::class, 'delete'])->name('delete-internship');

    // MIDDLEWARE FOR COMPANINES ONLY ; STOPS ALL USERS EVEN IF AUTHENTICATED IF THEY ARE NOT REGISTERED/SEEN AS A COMPANY
    Route::middleware([FirstAuth::class])->group(function () {
        // 
        // 
        // COMPANY RELATED ROUTES   
        //  
        Route::view('/company-dashboard', 'company.dashboard')->name('company-dashboard');
        Route::view('company-dashboard/employ', 'company.create')->name('create-employer');
        Route::get('/company/view-listings', [CompanyController::class, 'viewListings'])->name('company-listings');
        Route::get('/company/view-applications', [CompanyController::class, 'viewApplications'])->name('company-applications');

        // GET / RETRIEVE DATA FROM THE DATABASE
        Route::get('/company/info', [CompanyController::class, 'getCompanyInfo'])->name('company-info');
        Route::get('company/view-employers', [CompanyController::class, 'viewEmployers'])->name('view-employers');

        // POSTS
        Route::post('company-dashboard/employ', [CompanyController::class, 'createEmployer']);
    });
});



// View Routes
Route::view('/', 'pages.landing-page')->name('landing-page');
Route::get('/listings', [ListingController::class, 'getListingsAll'])->name('listings');
Route::get('/internships', [InternshipController::class, 'displayAllInternships'])->name('internships');


// GET ROUTES

Route::get('/listings{search?}', [ListingController::class, 'searchListingbyKey'])->name('search'); // FOR SEARCH FUNCTION - LISTINGS
Route::get('/internships{search?}', [InternshipController::class, 'searchListingbyKey'])->name('searchInternships');  // # FOR SEARCH FUNCTION - INTERNSHIPS
Route::get('/listing+location={location?}', [ListingController::class, 'searchListingbyLocation'])->name('searchLocation');
Route::get('listings+keys={key?}', [ListingController::class, 'searchListingByKeys'])->name('key');

Route::get('/internships/{id}', [InternshipController::class, 'getInternship'])->name('view-internship');
Route::get('/listings/{id}', [ListingController::class, 'getListing'])->name('view-listing');
Route::view('/index', 'pages.index')->name('index');
Route::view('/dashboard', 'pages.dahsboard')->name('dashboard');
Route::view('/landing-page', 'pages.landing-page')->name('landing-page');

// Login / Sign-UP ROUTES
// Route::view('/login-employee', 'auth.employee-login')->name('employee-login');
Route::view('/register-company', 'auth.employee-sign-up')->name('employee-sign-up');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.sign-up')->name('sign-up');

//  POST Routes
// Authentication / Login / Sign up
Route::post('/login-employee', [AuthController::class, 'login']);
Route::post('/register-company', [AuthController::class, 'registerCompany']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'registerApplicant']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::view('/login/forgot-password', 'pages.forgotPassword')->name('forgotPassword');
Route::post('/login/forgot-password', [AuthController::class, 'forgotPassword']);
// Reset Password