<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;


class ApplicantController extends Controller
{
    public function createResume(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'education' => ['required'],
            'work' => ['required'],
            'references' => ['required'],
            'email' => ['required', 'unique:users'],
            'contactNum' => ['required'],

        ]);
        // additional fields for session,


        // Questionable Code -> return here


        $applicant = Applicant::where('id', $request['id'])->get()->first();

        $applicant->resume = json_encode($fields);
        $applicant->save();
        session('applicant')->$applicant;
        return redirect()->route('profile');
    }

    public function checkResume()
    {
        $applicant =  Applicant::where('id', session('applicant')->id)->get()->first();
        return view('dashboard.resume', ['applicant' => $applicant]);
    }
}
