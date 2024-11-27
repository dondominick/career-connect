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
            'salary_min' => ['required', 'min:0'],
            'salary_max' => ['required', 'min:0', 'gt:salary_min'],
            'arrangement' => ['required'],
            'age_min' => ['required', 'min:0'],
            'age_max' => ['required', 'gt:age_min'],
            'location' => ['required'],
            'employer_id' => ['required'],
            'email' => ['required'],
            'companyID' => ['required'],
            'duration' => ['required'],
        ]);




        $fields['salary'] = $fields['salary_min'] . '-' . $fields['salary_max'];
        $fields['age'] = $fields['age_min'] . '-' . $fields['age_max'];
        $fields['skills'] = "";
        $fields['employer_id'] = session('employer')->id;
        $fields['description'] = json_decode($request['description']);
        $fields['requirements'] = json_decode($request['requirements']);
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
        // FROM HOME PAGE
        if ($request['job'] != "" && $request['location'] != "") {
            dd('condition 1');
            return view('ppages.internships', ['listings' => Internship::where('position', 'like', $request['job'] . '%')->where('location', 'like', $request['location'] . "%")->get()]);
        } elseif ($request['job']) {
            return view('pages.internships', ['listings' => Internship::where('position', 'like', $request['job'] . '%')->get()]);
        } elseif ($request['location']) {
            return view('pages.internships', ['listings' => Internship::where("location", 'like', $request['location'] . '%')->get()]);
        }

        // FROM LISTING PAGE

        // SORT LISTING BY DATE & MOST PICKED JOBS
        if ($request['key'] == "latest") {
            return view("pages.internships", ["listings" => Internship::orderBy('created_at', 'desc')->get()])->with(["red" => "1"]);
        }
        if ($request['key'] == "most") {
            return view('pages.internships', ["listings" => Internship::withCount('applications')->orderBy('applications_count', 'desc')->get()])->with(['blue' => "1"]);
        }

        // GENERAL SORTING AND FILTERING
        if ($request['key']) {
            $data = Internship::where($request['key'], $request['value'])->get();
            return view('pages.internships', ['listings' => $data]);
        }


        // IF ALL CONDITIONS ARE FAILED TO BE MET, PROCEED TO HERE -> FOR GENERAL SEARCHING
        return view('pages.internships', ['listings' => Internship::whereAny(['position', 'location', 'company'], 'like', $request['search'] . '%')->get()]);
    }
}
