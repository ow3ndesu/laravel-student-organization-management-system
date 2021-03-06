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
        return view('administrator.organizations');
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
            ->select('id')
            ->where('user_id', '=', Auth::id())
            ->where('status', '=', '1')
            ->get();

        return view('organization.organization', ["passed" => (Str::length($organization) != 2) ? 'true' : 'false']);
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
