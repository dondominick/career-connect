<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;

class InternshipController extends Controller
{

    private static $notif;

    private function getNotif()
    {
        if ($this::$notif) {
            return $this::$notif;

            dd($this::$notif . " old");
        }

        $this::$notif = new NotificationController();
        return new NotificationController();
    }
    public function create(Request $request)
    {
        $fields = $request->validate([
            'company' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'employer_id' => ['required'],
            'email' => ['required'],
            'companyID' => ['required'],
            'education' => ['required']
        ]);
        $fields['employer_id'] = session('employer')->id;
        if ($request['desc'] == null) {
            $fields['description'] = 'null';
        }
        if ($request['details'] == null) {
            $fields['requirements'] = 'null';
        }
        $fields['education'] = $request['education'];
        Internship::create($fields);
        $this->getNotif()->notifyCompany(
            $request['companyID'],
            "A new job internship has been created by your company. Employer " . $request['employer_id'] . " from your company has created the job listing",
            "New Job Internship",
            "warning-good"
        );

        return redirect()->route('employer-dashboard');
    }
    public function update(Request $request)
    {
        $fields = $request->validate([
            'salary' => ['required'],
            'location' => ['required'],
            'education' => ['required'],
            'email' => ['required'],
        ]);

        $internship = Internship::where('id', $request['id'])->first();
        $internship->salary = $fields['salary'];
        $internship->location = $fields['location'];
        $internship->email = $fields['email'];
        $internship->education = $fields['education'];
        $internship->save();

        return redirect()->route('employer-dashboard');
    }
    public function delete(Request $request)
    {

        Internship::where('id', $request['id'])->delete();
        $this->getNotif()->notifyCompany(
            session('employer')->companyID,
            "A job internship has been deleted by your company. Employer " . session('employer')->id . " from your company has deleted the job listing " . $request['id'],
            "Deleted Job Internship",
            "warning"
        );

        return redirect()->route('employer-dashboard')->with(['successful' => "Internship deleted sucessfully"]);
    }

    public function displayAllInternships()
    {
        return view('pages.internships', ['listings' => Internship::all()]);
    }

    public function getInternship($id)
    {
        return view('pages.view-internship', ['internship' => Internship::where('id', $id)->first()]);
    }

    public function searchListingbyKey(Request $request)
    {

        return view('pages.listing', ['listings' => Internship::whereAny(['location', 'company', 'education'], 'like', '%' . $request['search'] . '%')->get()]);
    }
}
