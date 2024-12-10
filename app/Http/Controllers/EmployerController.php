<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ListingController;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\ApplicationName;

class EmployerController extends Controller
{
    public function displayListings()
    {
        $listings =  Listing::where('employer_id', session('employer')->id)->get();
        $internships = Internship::where('employer_id', session('employer')->id)->get();

        return view('dashboard.employer-dashboard', ['listings' => $listings, "internships" => $internships]);
    }
    public function displayInternship($id)
    {
        $applications = Application::where('id', $id)->where('type', "internship")->where('status', "processing")->join('resumes', 'resumes.applicant_id', '=', 'applications.applicant_id')->get();

        return view('dashboard.internship-details', ['listing' => Internship::where('id', $id)->first(), 'applications' => $applications]);
    }
    public function displayListing($id)
    {
        $applications = Application::where('listing_id', $id)->where('type', "listings")->where('status', 'processing')->join('resumes', 'resumes.applicant_id', '=', 'applications.applicant_id')->get();
        return view('dashboard.details', ['listing' => Listing::where('id', $id)->get()->first(), 'applications' => $applications]);
    }

    public function updateListing($id)
    {
        return view('dashboard.update-internship', ['internship' => Internship::where('id', $id)->get()->first()]);
    }

    public function viewRejectedApplicants($id)
    {
        return view('dashboard.rejected-applicants');
    }

    public function statusCheck(Request $request)
    {
        $applications = Application::where('status', $request->status)->where('listing_id', $request['listing_id'])->where('type', $request['type'])->get();
        if ($request->status == "accepted") {
            return view('dashboard.accepted-applicants', ['applications' => $applications]);
        } elseif ($request->status == "rejected") {
            return view('dashboard.rejected-applicants', ['applications' => $applications]);
        }
        return back()->withErrors(['errors' => "Something went wrong!"]);
    }
}
