<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{


    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'education' => ['required'],
            'email' => ['required', 'unique:users'],
            'contact_no' => ['required'],
        ]);

        $fields['educational_background'] = $request->educational_background;
        $fields['work'] = $request->work_experience;
        $fields['references'] = $request->references;
        $fields['skills'] = $request->skills;

        if ($fields['education'] == "undergraduate" || $fields['education'] == "bachelor") {
            $request->validate([
                'degree' => ['required'],
            ]);
        }
        $fields['degree'] = $request->degree;
        $resume = Resume::create($fields);


        Applicant::where('id', session('applicant')->id)->update([
            'resume' => $resume->id
        ]);
        return redirect()->profiel()->with(['profile' => "Resume uploaded successfully"]);
    }
}
