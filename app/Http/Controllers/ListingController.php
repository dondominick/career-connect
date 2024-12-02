<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class ListingController extends Controller
{
    private static $notif;


    private function getNotif()
    {
        if ($this::$notif) {
            return $this::$notif;
        }
        return $this::$notif = new NotificationController();
        return new NotificationController();
    }

    public function getListingByEmployer($id)
    {
        return Listing::where('employer_id', $id)->get();
    }
    public function getListingById($id)
    {
        return Listing::where('id', $id)->get()->first();
    }

    public function getListing($id)
    {
        $listing = Listing::where('id', $id)->get()->first();
        return view('pages.view-listing', ['listing' => $listing]);
    }


    public function delete(Request $request)
    {

        $listing = Listing::where('id', $request['id']);
        $data = Employer::where('employers.id', $listing->get()->first()->employer_id)->join('companies', 'employers.companyID', '=', 'companies.id')->get()->first();
        if (!$listing->get()->first()) {
            return redirect()->route('profile')->withErrors('id', "Listing ID not found in the database");
        }

        $data['position'] = $listing->get()->first()->position;

        $this->getNotif()->deleteListing(
            $data->user_id,
            $data,
        );
        $listing->delete();
        return redirect()->route('employer-dashboard')->with(['successful' => "Listing deleted sucessfully"]);
    }


    public function update($id)
    {

        return view('dashboard.update-listing', ["listing" => $this->getListingById($id)]);
    }
    public function updateListing(Request $request)
    {
        $fields = $request->validate([
            'position' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'email' => ['required'],
            'education' => ['required']
        ]);
        $listing = Listing::where('id', $request['id'])->first();
        $listing->position = $fields['position'];
        $listing->salary = $fields['salary'];
        $listing->status = $request['status'];
        $listing->location = $fields['location'];
        $listing->email = $fields['email'];
        $listing->education = $fields['education'];

        $listing->save();

        return redirect()->route('employer-dashboard');
    }

    public function create(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'position' => ['required'],
            'company' => ['required'],
            'min_salary' => ['required', 'min:0'],
            'max_salary' => ['required', 'min:0', 'gt:min_salary'],
            'arrangement' => ['required'],
            'min_age' => ['required', 'min:0'],
            'max_age' => ['required', 'gt:min_age'],
            'location' => ['required'],
            'employer_id' => ['required'],
            'email' => ['required'],
            'companyID' => ['required'],
            'type' => ['required'],
            'experience' => ['required'],

        ]);

        if ($request['type'] == 'temporary' || $request['type'] == 'contract') {
            $request->validate([
                "duration" => ['required', 'numeric', 'min:0']
            ]);
            $fields['duration'] = $request['duration'];
        }

        if ($request['type'] == 'part-time') {
            $request->validate([
                "hours" => ['required', 'numeric', 'min:0']
            ]);
            $fields['hours'] = $request['hours'];
        }
        $fields['employer_id'] = session('employer')->id;
        $fields['description'] = json_decode($request['description']);
        $fields['requirements'] = json_decode($request['requirements']);
        $fields['skills'] = json_encode($request['request']);
        $fields['education'] = $request['education'];
        $listing = Listing::create($fields);
        $fields['listing_id'] = $listing->id;
        $this->getNotif()->newListing(
            $fields['employer_id'],
            json_encode($fields)
        );

        // add data to the database
        return redirect()->route('employer-dashboard');
    }
    // 
    // 
    // FOR SORT, SEARCH, AND FILTERS METHODS
    // 
    // 
    // 
    public function searchListingbyKey(Request $request)
    {
        // FROM HOME PAGE
        if ($request['job'] != "" && $request['location'] != "") {
            return view('pages.listing', ['listings' => Listing::where('position', 'like', $request['job'] . '%')->where('location', 'like', $request['location'] . "%")->get()]);
        } elseif ($request['job']) {
            return view('pages.listing', ['listings' => Listing::where('position', 'like', $request['job'] . '%')->get()]);
        } elseif ($request['location']) {
            return view('pages.listing', ['listings' => Listing::where("location", 'like', $request['location'] . '%')->get()]);
        }

        // FROM LISTING PAGE

        // SORT LISTING BY DATE & MOST PICKED JOBS
        if ($request['key'] == "latest") {
            return view("pages.listing", ["listings" => Listing::orderBy('created_at', 'desc')->get()])->with(["red" => "1"]);
        }
        if ($request['key'] == "most") {
            return view('pages.listing', ["listings" => Listing::withCount('applications')->orderBy('applications_count', 'desc')->get()])->with(['blue' => "1"]);
        }

        // GENERAL SORTING AND FILTERING
        if ($request['key']) {
            $data = Listing::where($request['key'], $request['value'])->get();
            return view('pages.listing', ['listings' => $data]);
        }


        // IF ALL CONDITIONS ARE FAILED TO BE MET, PROCEED TO HERE -> FOR GENERAL SEARCHING
        return view('pages.listing', ['listings' => Listing::whereAny(['position', 'location', 'company'], 'like', $request['search'] . '%')->get()]);
    }

    public function searchListingbyLocation(Request $request)
    {

        return view('pages.listing', ['listings' => Listing::where('location', 'like', $request['location'] . '%')->get()]);
    }

    // FOR RECOMMENDING USERS LISTINGS BASED ON THEIR LOCATION / ADDRESS
    public function recommendUsers()
    {

        if (isset(session('applicant')->resume)) {
            $recommendation = Listing::select('*')->where('location', json_decode(session('applicant')->resume)->address)->take(3)->get();
            $listings = Listing::select('*')->join('companies', 'listings.companyID', '=', 'companies.id')->orderBy('listings.created_at')->take(3)->get();
            $notifications = NotificationController::class::retrieveNotifications();
            return view('pages.home', ['listings' => $listings, 'recommends' => $recommendation, "notifications" => $notifications]);
        }
        $recommends =  Listing::withCount('applications')->orderBy('applications_count', 'desc')->take(3)->get();
        $listings = Listing::select('*')->join('companies', 'listings.companyID', '=', 'companies.id')->orderBy('listings.created_at')->take(3)->get();
        $notifications = NotificationController::class::retrieveNotifications();
        return view('pages.home', ['listings' => $listings, 'recommends' => $recommends, "notifications" => $notifications]);
    }

    // 
    // RECOMMENDATION SYSTEM
    // 
    private function recommendationSystemBySkills()
    {
        $resume = json_decode(session('applicant')->resume);
        $first = Listing::where("location", $resume->skills)->select('*', '*', DB::raw("1 as priority"));
        $second = DB::table('listings')->select('*', '*', DB::raw('2 as priority'));
        if ($first->first() && $second) {
            $listings = $first->union($second)->orderBy('priority', 'asc')->get();
            $sorted = $listings->sortBy('priority');
            dd($sorted->values()->all());
        }
        return Listing::all();
    }

    private function recommendationSystemByLocation()
    {
        $resume = json_decode(session('applicant')->resume);
        $first = Listing::where("location", $resume->address)->select('*', DB::raw("1 as priority"));
        $second = DB::table('listings')->select('*', DB::raw('2 as priority'))->where("location", "!=", $resume->address);
        if ($first->first() && $second) {
            $listings = $first->union($second)->orderBy('priority', 'asc')->orderBy('created_at', 'asc')->get();
            return $listings;
        }
        return Listing::all()->orderBy('created_at');
    }


    public function getListingsAll()
    {
        if (!isset(session('applicant')->resume)) {
            return view('pages.listing', ['listings' => Listing::all()]);
        }
        if (session('applicant')->resume) {
            return view('pages.listing', ['listings' => $this->recommendationSystemByLocation()],);
        }
        return view('pages.listing', ['listings' => Listing::all()]);
    }
}
