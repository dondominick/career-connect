<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Employer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{


    // Notification Templates for Notification Details
    private static $listing_template = "
        Dear :company_head,

        We are pleased to inform you that a new job listing has been successfully created on the company platform. Below are the details of the listing:
        <br>
        Job Title: :job_title <br>
        Work Arrangement: :arrangement <br>
        Location: :location <br>
        Job Type: :job_type <br>
        Salary Range: :salary <br>
        Created By: :employer_name <br>
        <br>
        The job listing is now live and accessible to potential candidates. You can review the listing and monitor its progress via the company dashboard.
            <br>
        <a href='{{route('view-listings', :listing_id )}}'>View Job Listing</a>
            <br>  
            ";

    private static $internship_template = "
        Dear :company_head,
    
        We are pleased to inform you that a new internship listing has been successfully created on the company platform. Below are the details of the listing:
        <br>
        Job Title: : Intern <br>
        Work Arrangement: :arrangement <br>
        Location: :location <br>
        Job Type: :job_type <br>
        Salary Range: :salary <br>
        Created By: :employer_name <br>
        <br>
        The job listing is now live and accessible to potential candidates. You can review the listing and monitor its progress via the company dashboard.
            <br>
        <a href='{{route('view-listings', :listing_id )}}'>View Job Listing</a>
            <br>  
            ";
    private static $applicant_template = "
        Dear :applicant_name,
    
        Thank you for applying for the :job_title position at :company_name.
            <br>
        We have successfully received your application, and it is currently under review by our team. Below are the details of your application:
        <br>
        Job Title: :job_title <br>
        Work Arrangement: :arrangement <br>
        Location: :location <br>
        Job Type: :job_type <br>
        Salary Range: :salary <br>
        Company Name:  :company_name
        Submission Date: :submission_date
        <br>
       Our team will carefully evaluate your profile and contact you if your application progresses to the next stage. Please feel free to reach out if you have any questions in the meantime.
            <br>
           Thank you for your interest in joining our team. We wish you the best of luck!
        <br> 
        <a href='{{route('view-listings', :listing_id )}}'>View Job Listing</a>
            <br>  
            ";

    private static $application_template = "
        Dear :company_head,
            
        We are excited to inform you that a new application has been submitted for the :job_title position at :company_name.
        <br>
        Here are the applicant's details:
        <br>
        Name: :applicant_name<br>
        Email: :applicant_email <br>
        Contact Number: :applicant_contact<br>

        <br>
        You can review the application and take the necessary steps via the employer dashboard.
            <br>
        <a href='{{route('employer-dashboard')}}'>View Job Listing</a>
            <br>  
            ";

    private static $application_update_template = "
        Dear :applicant_name,

        We are writing to update you on the status of your application for the {{ Job Title }} position at :company_name.

        Current Status: :application_status

        We appreciate your patience throughout the hiring process and will keep you informed about any further updates. If you have any questions, feel free to contact us at :company_email.";


    // Templates for Notification Summary

    private static $summary_newlistings = "
        We are pleased to inform you that a new job listing for the :job_title position has been successfully created on the company platform.
    ";
    private static $summary_newinternship = "
    We are pleased to inform you that a new internship position has been successfully created on the company platform.
";
    private static $summary_updatelistings = "
     The :job_title position at :company_name has been updated. Status: :status.
    ";
    private static $summary_deletelistings = "
     The :job_title position at :company_name has been deleted.
    ";

    private static $summary_updateinternship = "
    The Intern position at :company_name has been updated. Status: :status.
   ";
    private static $summary_listingstatus = "
        We are pleased to inform you that a new job listing for the :job_title position has been successfully created on the company platform.
    ";
    private static $summary_applicant = "
    Hi :applicant_name, your application for the :job_title position at :company has been received and is under review. Thank you for applying!
    ";

    private static $summary_employers = "
    Hi, a new application has been submitted for the :job_title position by :applicant_name.
    ";

    private static $summary_application = "
    Your application for :job_title at :company_name is :status.
    ";


    // Templates for Notification Title

    private static $title_applicants = "
        Application Submitted: :job_title
    ";

    private static $title_employers = "
        New Application: :job_title
    ";

    private static $title_application = "
        Application Status Update for :job_title
    ";

    private static $title_newlisting = "
        New Job Listing Created: :job_title
    ";
    private static $title_deletelisting = "
     Job Listing :listing_id for the position, :job_title Deleted: 
";
    private static $title_newinternship = "
        New Job Internship Created
    ";


    private static $title_updatelisting = "
        Update on Job Listing :listing_id for the position :job_title
";

    // For creating notifications:
    // notification for applicants and employers
    // notifies the applicants and employers about their application
    public function newApplication($user_id, $body)  // working
    {

        // For applicants 
        $summary = str_replace(
            [':applicant_name', ':job_title', ':company'],
            [$body['applicant_name'], $body['position'], $body['company_name']],
            $this::$summary_applicant
        );
        $title = str_replace(
            [':job_title'],
            [$body['position']],
            $this::$title_applicants
        );
        Notification::create([
            "user_id" => Applicant::where('id', $user_id['applicant'])->get()->first()->user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "successful",
            "summary" => $summary
        ]);
        // For Employers
        $title = str_replace(
            [':job_title'],
            [$body['applicant_name']],
            $this::$title_employers
        );
        $summary = str_replace(
            [':job_title', ':applicant_name',],
            [$body['position'], $body['applicant_name']],
            $this::$summary_employers
        );
        $user =  Notification::create([
            "user_id" => Employer::where('id', $user_id['employer'])->get()->first()->user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "new-application",
            "summary" => $summary
        ]);
    }


    // notifications for applicants;
    // Notifies the applicant's about their application's current status;
    public function ApplicationUpdate($user_id, $body, $status) // to be tested
    {
        $body = json_decode($body);

        $employer = Employer::where('id', $body->employer_id)->get()->first();
        $body->company = $employer->company;
        $title = str_replace(
            [':job_title'],
            [$body->position],
            $this::$title_application
        );
        $summary = str_replace(
            [':job_title', ':company_name', ':status'],
            [$body->position, $body->company, $status],
            $this::$summary_application
        );

        $notif = Notification::create([
            "user_id" => $user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => $status,
            "summary" => $summary
        ]);
        return back()->with('successful', "application updated succssful");
    }

    // For Companies
    // new listing
    public function newListing($user_id, $body) // working
    {
        $body = json_decode($body);

        $title = str_replace(
            [':job_title', ':listing_id'],
            [$body->position, $body->listing_id],
            $this::$title_newlisting
        );
        $summary = str_replace(
            [':job_title'],
            [$body->position],
            $this::$summary_newlistings
        );
        return Notification::create([
            "user_id" => $user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "new-listing",
            "summary" => $summary
        ]);
    }
    public function newInternship($user_id, $body) // to be tested
    {
        $body = json_decode($body);

        $title = $this::$title_newinternship;

        $summary = $this::$summary_newinternship;

        return Notification::create([
            "user_id" => $user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "new-internship",
            "summary" => $summary
        ]);
    }



    // listing update 

    public function updateListing($user_id, $body, $status) // to be tested
    {
        $body = json_decode($body);

        $title = str_replace(
            [':listing_id', ':job_title'],
            [$body['listing_id'], $body['position']],
            $this::$title_updatelisting
        );
        $summary = str_replace(
            [':job_title', ':company_name', ":status"],
            [$body['position'], $body['company'], $status],
            $this::$summary_updatelistings
        );
        return Notification::create([
            "user_id" => $user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "new-listing",
            "summary" => $summary
        ]);
    }

    public function updateInternship($user_id, $body, $status) // to be tested
    {
        $body = json_decode($body);

        $title = str_replace(
            [':listing_id', ':job_title'],
            [$body['listing_id'], "Intern"],
            $this::$title_updatelisting
        );
        $summary = str_replace(
            [':company_name', ":status"],
            [$body['company'], $status],
            $this::$summary_updateinternship
        );
        return Notification::create([
            "user_id" => $user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "new-listing",
            "summary" => $summary
        ]);
    }

    // Delete Listing

    public function deleteListing($user_id, $body) // tested
    {
        $body = json_decode($body);
        $title = str_replace(
            [':job_title', ':listing_id'],
            [$body->position, $body->id],
            $this::$title_deletelisting
        );
        $summary = str_replace(
            [':job_title', ":company_name"],
            [$body->position, $body->company],
            $this::$summary_deletelistings
        );
        return Notification::create([
            "user_id" => $user_id,
            "body" => json_encode($body),
            "title" => $title,
            "status" => "delete-listing",
            "summary" => $summary
        ]);
    }

    // Detailed Notifications
    public function viewApplication() // to be tested
    {}



    // 

    // Display Nofitications 

    public function displayNotifications()
    {
        $notifications = Notification::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        if (!$notifications->first()) {
            return view('dashboard.notification');
        }
        return view('dashboard.notification', ["notifications" => $notifications]);
    }


    // 

    public function createNotification($user_id, $body, $title, $status)
    {
        return Notification::create([
            "user_id" => $user_id,
            "body" => $body,
            "title" => $title,
            "status" => $status,
        ]);
    }
    public static function createNotifications($user_id, $body, $title, $status)
    {
        return Notification::create([
            "user_id" => $user_id,
            "body" => $body,
            "title" => $title,
            "status" => $status,
        ]);
    }

    public function updateNotification($status) {}

    public function Applicant_findUser($id)
    {
        return Applicant::where('id', $id)->get()->first()->user_id;
    }

    public function Employer_findUser($id)
    {
        return Employer::where('id', $id)->get()->first()->user_id;
    }

    public function notifyCompany($company_id, $body, $title, $status)
    {
        $employers = DB::table('employers')
            ->where('employers.companyID', $company_id)
            ->where('users.position', "company")
            ->join('users', 'employers.user_id', '=', 'users.id')
            ->get()
            ->first();
        $this->createNotification($employers->user_id, $body, $title, $status);
    }


    public static function retrieveNotifications()
    {
        return Notification::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(6)->get();
    }


    // Notification Templates 
}
