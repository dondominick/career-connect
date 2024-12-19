<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{


    public static function create(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'education' => ['required'],
            'email' => ['required'],
            'contact_no' => ['required'],
        ]);
        // PROCESS THE DATA


        // END THE DATA
        $fields['educational_background'] = $request->educational_background;
        $fields['work'] = $request->work_experience;
        $fields['reference'] = $request->reference;
        $fields['skills'] =  $request->skills;

        if ($fields['education'] == "undergraduate" || $fields['education'] == "bachelor") {
            $request->validate([
                'degree' => ['required'],
            ]);
        }
        $fields['undergrad'] = $request->degree;
        $fields['applicant_id'] = session('applicant')->id;
        //dd($fields);
        $resume = Resume::create($fields);
        $applicant = Applicant::where('id', session('applicant')->id);
        $applicant->update([
            'resume' => $resume->id
        ]);

        session()->put(
            'resume',
            $applicant->get()->first
        );


        return redirect()->route('profile')->with(['profile' => "Resume uploaded successfully"]);
    }

    public function update(Request $request)
    {

        $fields = $request->validate([
            'name' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'education' => ['required'],
            'email' => ['required'],
            'contact_no' => ['required'],
        ]);

        // PROCESS THE DATA

        // END THE DATA PROCESSING

        // DATA SETTING FIELDS
        $fields['educational_background'] = $request->educational_background;
        $fields['work'] = $request->work_experience;
        $fields['reference'] = $request->reference;
        $fields['skills'] =  $request->skills;

        if ($fields['education'] == "undergraduate" || $fields['education'] == "bachelor") {
            $request->validate([
                'degree' => ['required'],
            ]);
        }
        $fields['undergrad'] = $request->degree;

        // FIND THE RESUME FOR UPDATE
        $applicant = Resume::where('applicant_id', session('applicant')->id);
        $applicant->update($fields);
        session()->put(
            'resume',
            $applicant->get()->first()
        );

        return redirect()->route('profile')->with(['profile' => "Resume update successful"]);
    }
    private function data_processing() {}
}
