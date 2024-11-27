<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Company;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use function Laravel\Prompts\confirm;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required'],
            "password" => ['required']
        ]);

        $remember = $request->has('remember');
        if (Auth::attempt($fields, $remember)) {
            $request->session()->regenerate();
            session(["user" => Auth::user()]);
            if (Auth::user()->position == "applicant") {
                session([
                    "applicant" => DB::table('applicants')
                        ->where('user_id', '=', Auth::id())
                        ->get()
                        ->first()
                ]);
            } elseif (Auth::user()->position == 'company') {
                session([
                    "employer" => DB::table('employers')
                        ->where('user_id', '=', Auth::id())
                        ->get()
                        ->first()
                ]);
                session([
                    "company" => DB::table('companies')
                        ->where('id', '=', session('employer')->companyID)
                        ->get()
                        ->first()
                ]);
            } else {
                session([
                    "employer" => DB::table('employers')
                        ->where('user_id', '=', Auth::id())
                        ->get()
                        ->first()
                ]);
            }


            return redirect()->intended('profile');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials does not match our record.'
            ]);
        }
    }



    public function registerApplicant(Request $request)
    {
        $fields = $request->validate([
            'fname' => ['required', 'max:255'],
            'lname' => ['required', 'max:255'],
            'email' => ['required', 'unique:users', 'max:255', 'email'],
            'birthdate' => ['required'],
            'password' => ['required', 'min:3'],
            'gender' => ['required']
        ]);
        $fields["position"] = "applicant";
        $user = User::create($fields);
        $fields['user_id']  = $user->id;
        $applicant = Applicant::create($fields);
        session(['applicant' => $applicant]);
        Auth::login($user);
        return redirect()->route('profile');
    }


    public function registerCompany(Request $request)
    {
        // Validate input fields 
        $company = $request->validate([
            'companyName' => ['required'],
            'companyLocation' => ['required'],
            'companySize' => ['required'],
            'companyIndustry' => ['required'],
            "companyNum" => ['required'],
            "contactPerson" => ['required'],
            "companyEmail" => ['required', 'unique:companies', 'email', 'unique:users']

        ]);
        $user = $request->validate([
            'fname' => ['required', 'max:255'],
            'lname' => ['required', 'max:255'],
            'birthdate' => ['required'],
            'password' => ['required', 'min:3', 'confirmed'],
            'gender' => ['required']
        ]);

        $employer = $request->validate([
            "position" => ['required'],
            "contactNum" => ['required']
        ]);

        $user["position"] = "company";
        $user['email'] = $company['companyEmail'];
        // if validation is successful, insert the data into the database 
        $comp = Company::create($company); // insert company info into the company table
        $users = User::create($user); // insert user info to the user table
        $employer_info = Employer::create([
            "job_title" => $employer['position'],
            "fname" => $user['fname'],
            "lname" => $user['lname'],
            "email" => $company['companyEmail'],
            "contactNum" => $employer['contactNum'],
            "gender" => $user['gender'],
            "company" => $company['companyName'],
            "companyID" => $comp->id,
            "user_id" => $users->id,
            "birthdate" => $users->birthdate
        ]); // insert employer info to the employer table

        Auth::login($users);
        session(['employer' => $employer_info]);
        session(['company' => $comp]);
        return redirect()->route('profile');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function update(Request $request)
    {
        if ($request->has('profile')) {
            dd('hi');
            $this->updateProfile($request);
        } elseif ($request->has('update-info')) {
            dd('hello');
        }
    }

    public function updateProfile(Request $request)
    {
        $fields = $request->validate([
            "profile" => ['required', 'max:11000']
        ]);


        // Check if the file was uploaded
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_profile';

            // Store the file in the 'resumes' directory under the 'public' disk

            $filePath = $file->storeAs('profiles', $fileName . '.' . $file->getClientOriginalExtension(), 'public');
            $user =  User::where('id', Auth::id())->get()->first();
            $user->profile = $filePath;
            Auth::user()->profile = $filePath;
            $user->save();
            return redirect()->back()->with(['success' => 'Profile uploaded successfully!']);
        }
        return redirect()->back()->withErrors(['failed' => 'Failed to upload profile picture']);
    }

    public function forgotPassword(Request $request) {}
}
