<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Organization;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function historyView()
    {
        return view('history');
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
        $events = DB::table('events')
            ->select('*')
            ->where('status', '=', '1')
            ->whereBetween('date_time', [Carbon::now(), 'out'])
            ->whereDate('out', '<', [Carbon::now(),'date_time' ])
            ->get();

        $announcements = DB::table('announcements')
            ->select('*')
            ->where('status', '=', '1')
            ->get();

        return view('student.home', ["events" => $events, "announcements" => $announcements]);
    }

    public function feedTab()
    {
        $events  = DB::table('events')
            ->select('*')
            ->where('status', '=', '1')
            ->get();

        $modifiedevents = [];

        foreach ($events as $row) {
            $ts_in = new DateTime($row->date_time);
            $in = (int) $ts_in->getTimestamp();
            $ts_out = new DateTime($row->out);
            $out = (int) $ts_out->getTimestamp();
            $ts_now = new DateTime();
            $now = (int) $ts_now->getTimestamp();

            if($in <= $now && $out >= $now) {
                array_push($modifiedevents, $row);
                // $modifiedevents[] = $row;
            }
        }

        return view('student.feed', ["events" => $modifiedevents]);
    }

    public function organizationView()
    {
        $status = DB::table('organizations')
            ->select('status')
            ->where('user_id', '=', Auth::id())
            ->first();
        // $status->status = ($status != null) ? $status->status : 0;
        $stats = ($status != null) ? $status->status : 0;
        return view('organization.home', ["status" => $stats]);
    }

    public function organizationTab()
    {
        $organization  = DB::table('organizations')
            ->select('*')
            ->where('user_id', '=', Auth::id())
            ->first();

        $events  = DB::table('events')
            ->select('*')
            ->where('status', '=', '1')
            ->get();

        if ($organization != null) {
            // echo '<script>console.log(' . var_dump($organization) .')</script>';
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
