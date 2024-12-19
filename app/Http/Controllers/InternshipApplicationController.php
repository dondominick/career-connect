<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Internship;
use App\Models\InternshipApplication;
use Illuminate\Support\Facades\Auth;

class InternshipApplicationController extends Controller
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

        if (InternshipApplication::where('applicant_id', $applicant->id)->where('internship_id', $request['listing_id'])->get()->first()) {
            return back()->withErrors(['failed' => "You already applied to this job listing or internship"]);
        }

        if ($applicant->resume) {
            $fields = [
                "resume" => $applicant->resume,
                "applicant_id" => $request['applicant_id'],
                "employer_id" => $request['employer_id'],
                "companyID" => $request['companyID'],
                "internship_id" => $request['listing_id'],
                "type" => $request['type']
            ];

            $application = InternshipApplication::create($fields);
            $data = Internship::where('internships.id', $request['listing_id'])->join('employers', 'internships.employer_id', '=', 'employers.id')->get()->first();

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
                    'internship_id' => $application->listing_id
                ]
            );


            return back()->with(['success' => "Successfully applied to the listing"]);
        }

        return back()->withErrors([
            'resume' => "Applicant doesn't have a resume"
        ]);
    }

    public function updateApplication(Request $request)
    {

        $application =  InternshipApplication::where('internships_applications.internship_id', $request['listing_id'])
            ->where('applicant_id', $request['applicant_id'])
            ->where('internships_applications.status', '=', 'processing')
            ->join('applicants', 'internships_applications.applicant_id', '=', 'applicants.id')
            ->join('internships', 'internships_applications.internship_id', '=', 'internships.id');;


        $applications =  $application->get()->first();
        $application->update([
            "internships_applications.status" => $request['status']
        ]);

        $applications->position = "Intern";

        $this->getNotif()->ApplicationUpdate(
            $applications->user_id,
            $applications,
            $request['status']
        );


        return back()->with(['success' => "Applicant " . $request['id'] . " has been " . $request['status']]);
    }
}
