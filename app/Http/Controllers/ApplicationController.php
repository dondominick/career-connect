<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;
use App\Models\Internship;
use App\Models\Listing;

class ApplicationController extends Controller
{
    private static $notif;


    private function getNotif()
    {
        if ($this::$notif) {
            return $this::$notif;
        }

        $this::$notif = new NotificationController();
        return new NotificationController();
    }
    public function checkResume(Request $request)
    {
        $applicant =  Applicant::where('id', $request['applicant_id'])->get()->first();

        if (Auth::user()->position != "applicant") {
            return back()->withErrors(['position' => "Only applicants are allowed to apply in job listings and internships"]);
        }

        if (Application::where('applicant_id', $applicant->id)->where('listing_id', $request['listing_id'])->where('type', $request['type'])->get()->first()) {
            return back()->withErrors(['failed' => "You already applied to this job listing or internship"]);
        }


        if ($applicant->resume) {
            $fields = [
                "resume" => $applicant->resume,
                "applicant_id" => $request['applicant_id'],
                "employer_id" => $request['employer_id'],
                "companyID" => $request['companyID'],
                "listing_id" => $request['listing_id'],
                "type" => $request['type']
            ];

            $application = Application::create($fields);
            $data = Listing::where('listings.id', $request['listing_id'])->join('employers', 'listings.employer_id', '=', 'employers.id')->get()->first();

            $this->getNotif()->newApplication(
                ["applicant" => $application->applicant_id, "employer" => $application->employer_id],
                [
                    "applicant_name" => $applicant->fname . " " . $applicant->lname,
                    'applicant_email' => $applicant->email,
                    'applicant_contact' => "09916216576",
                    'position' => $data->position,
                    'company_name' => $data->company,
                    'company_head' => $data->company,
                    'arrangement' => $data->arrangement,
                    'location' => $data->location,
                    'job_type' => $data->type,
                    'salary' => $data->salary,
                    'submission_date' => $application->created_at,
                    'listing_id' => $application->listing_id
                ]
            );


            return back()->with(['success' => "Successfully applied to the listing"]);
        }

        return back()->withErrors([
            'resume' => "Applicant doesn't have a resume"
        ]);
    }

    public function resume() {}

    public function updateApplication(Request $request)
    {
        $type = $request['type'];
        if ($type == "listings") {
            $application =  Application::where('applicant_id', $request['applicant_id'])->where('type', $request['type'])->where('status', '=', 'processing')->join('applicants', 'applications.applicant_id', '=', 'applicants.id');
            $application->update([
                "status" => $request['status']
            ]);
        } else {
            dd('condition 3');
            $application = Application::where('applicant_id', $request['applicant_id'])->where('type', $request['type'])->join('applicants', 'applications.applicant_id', '=', 'applicants.id');
            $application->update([
                "status" => $request['status']
            ]);
        }
        $application =  $application->get()->first();

        $this->getNotif()->ApplicationUpdate(
            $application->user_id,
            $application,
            $request['status']
        );


        return back()->with(['success' => "Applicant " . $request['id'] . " has been " . $request['status']]);
    }
}
