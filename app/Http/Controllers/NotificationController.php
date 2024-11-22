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
    public function createNotification($user_id, $body, $title, $status)
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

    public function displayNotifications()
    {
        $notifications = Notification::where('user_id', Auth::id())->get();
        if (!$notifications->first()) {
            return view('dashboard.notification');
        }
        return view('dashboard.notification', ["notifications" => $notifications]);
    }
}
