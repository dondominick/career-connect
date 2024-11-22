<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;


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
            dd('working');
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
            Application::create($fields);
            $id = $this->getNotif()->Employer_findUser($request['employer_id']);
            $body = "Applicant #" . $request['applicant_id'] . " has applied to your job " . $request['type'] . " " . $request['listing_id'];
            $title = "New Application!";
            $status = "warning";


            $this->getNotif()->createNotification($id, $body, $title, $status);
            $this->getNotif()->createNotification(
                $this->getNotif()->Applicant_findUser($request['applicant_id']),
                "You have successfully applied for " . $request['type'] . " " . $request['listing_id'] . " . Your application is currently on process.",
                "Application Succesful!",
                "success"
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
        if ($request['status'] == "accepted") {
            $this->separateType($request);
        }
        if ($request['status'] == "rejected") {
            $this->separateType($request);
        }

        return back()->withErrors(['error' => "Something went wrong!"]);
    }

    private function separateType(Request $request)
    {
        $type = $request['type'];
        if ($type == "listings") {
            $application =  Application::where('applicant_id', $request['applicant_id'])->where('type', $request['type'])->get()->first();
            $application->status = $request['status'];

            $body = "Your application for listing #" . $request['listing_id'] . " has been " . $request['status'];


            $application->save();
        } else {
            $application = Application::where('applicant_id', $request['applicant_id'])->where('type', $request['type'])->get()->first();
            $application->status = $request['status'];

            $body = "Your application for internship #" . $request['listing_id'] . " has been " . $request['status'];

            $application->save();
        }
        $title = "Application Update";
        $id = $this->getNotif()->Applicant_findUser($request['applicant_id']);
        $this->getNotif()->createNotification($id, $body, $title, $request['status']);

        return back()->with(['success' => "Applicant " . $request['id'] . " has been " . $request['status']]);
    }
}
