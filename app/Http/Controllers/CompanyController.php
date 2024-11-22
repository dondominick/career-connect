<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employer;
use App\Models\Internship;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function companyDashboard()
    {
        return view('company.dashboard');
    }

    public function createEmployer(Request $request)
    {
        $fields = $request->validate([
            "fname" => ['required'],
            "lname" => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'unique:users'],
            'contactNum' => ['required'],
            'position' => ['required'],
            'salary' => ['required'],
            'password' => ['required', 'confirmed', 'min:3'],
            'company' => ['required'],
            'companyID' => ['required'],
            "birthdate" => ['required']
        ]);
        $fields['position'] = "employer";
        $user = User::create($fields);
        $fields['position'] = $request->position;
        $fields['user_id'] = $user->id;
        Employer::create($fields);

        return redirect()->route('company-dashboard')->with(['employers' => "Employer created successfully"]);
    }

    public function viewEmployers()
    {
        $employers = Employer::where('companyID', session('company')->id)->get();
        return view('company.view-employers', ["employers" => $employers]);
    }

    public function viewListings()
    {
        $listings = Listing::where('companyID', session('company')->id)->get();
        $internships = Internship::where('companyID', session('company')->id)->get();

        return view('company.view-listings', ['listings' => $listings, 'internships' => $internships]);
    }

    public function viewApplications()
    {
        $applications = Application::where('companyID', session('company')->id)->get();
        return view('company.view-applications', ['applications' => $applications]);
    }
    public function getCompanyInfo()
    {


        return view('company.company-info');
    }
}