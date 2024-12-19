<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function update(Request $request)
    {
        if ($request->has('profile')) {
            $this->updateProfile($request);
        } elseif ($request->has('update-password')) {
            $this->updatePassword($request);
        } elseif ($request->has('update-info')) {
            $this->updateInfo($request);
        }

        return back()->withErrors(['error' => "Something went wrong"]);
    }

    public function updateInfo(Request $request)
    {
        $fields = $request->validate([
            "fname" => ['required'],
            "lname" => ['required'],
            "birthdate" => ['required'],
        ]);

        $user = User::where('id', Auth::id())->update($fields);
        if (session()->has('employer')) {

            // dd(Auth::id());
            $employer = Employer::where('user_id', Auth::id())->update($fields);

            // dd($employer);
        } elseif (session()->has('applicant')) {
            $applicant = Applicant::where('user_id', Auth::id())->update($fields);
        }

        return back()->with(['profile' => "Update sucessful"]);
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


    private function updatePassword(Request $request)
    {
        dd('Password is changing');
    }
}
