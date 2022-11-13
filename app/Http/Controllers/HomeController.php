<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('student.home');
    }

    public function archiveView()
    {
        return view('archive');
    }

    public function profileView()
    {
        return view('profile');
    }

    public function adminView()
    {
        return view('administrator.home');
    }

    public function administratorsTab()
    {
        return view('administrator.administrators');
    }

    public function organizationsTab()
    {
        $events  = DB::table('events')
            ->select('*')
            ->get();

        return view('administrator.organizations', ["events" => $events]);
    }

    public function studentsTab()
    {
        return view('administrator.students');
    }

    public function studentView()
    {
        return view('student.home');
    }

    public function feedTab()
    {
        return view('student.feed');
    }

    public function organizationView()
    {
        return view('organization.home');
    }

    public function organizationTab()
    {
        $organization  = DB::table('organizations')
            ->select('*')
            ->where('user_id', '=', Auth::id())
            ->first();

        $events  = DB::table('events')
            ->select('*')
            ->get();

        if ($organization != null) {
            return view('organization.organization', ["events" => $events, "status" => $organization == null || $organization->status == 0 ? 'pending' : ($organization->status == 1 ? 'approved' : ($organization->status == 2 ? 'renewal' : 'disapproved')), "name" => ($organization->status == 1 || $organization->status == 2 ? $organization->name : "Student Organization"), "organizationid" => $organization->id]);
        } else {
            return view('organization.organization', ["events" => $events, "status" => $organization == null || $organization->status == 0 ? 'pending' : ($organization->status == 1 ? 'approved' : ($organization->status == 2 ? 'renewal' : 'disapproved')), "name" => "Student Organization", "organizationid" => 0]);
        }
    }

    protected function update(Request $data)
    {

        if (Hash::check($data->password, Auth::user()->password)) {
            try {
                $update = DB::table('users')
                    ->where('id', '=', Auth::id())
                    ->update([
                        'name' => $data->name,
                        'email' => $data->email,
                    ]);

                return $update;
            } catch (\Throwable $e) {
                return $e;
            }
        } else {
            $passworderror = 'Password is incorrect!';
            return $passworderror;
        }
    }
}
