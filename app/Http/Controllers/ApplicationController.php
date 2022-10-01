<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Application = new Application();
            $Application->user_id = Auth::id();

            $validator = Validator::make($request->all(), [
                'applicationform' => 'required|max:2048',
                'advisersform' => 'required|max:2048'
            ]);

            if ($validator->fails()) {
                return $validator->errors()->all();
            } else {
                $applicationform = $request->file('applicationform');
                $advisersform = $request->file('advisersform');
                $appf_filename = $request->name . "_ApplicationForm." . $applicationform->getClientOriginalExtension();
                $advf_filename = $request->name . "_AdvisersCommitmentForm." . $advisersform->getClientOriginalExtension();
                $appf_extension = $applicationform->getClientOriginalExtension();
                $advf_extension = $advisersform->getClientOriginalExtension();
                $location = "files/application/" . $request->name;

                $applicationform->move($location, $appf_filename);
                $advisersform->move($location, $advf_filename);

                $Organization = new Organization();
                $Organization->user_id = Auth::id();
                $Organization->name = $request->name;
                $Organization->save();

                $Application->organization_id = $Organization->id;
                $Application->application_form = $location . "/" . $appf_filename;
                $Application->advisers_commitment_form = $location . "/" . $advf_filename;
                $Application->submitted_at = date('m/d/Y');
                $Application->save();

                if ($Application) {
                    return true;
                }
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    public function getMyApplication()
    {
        $all = Application::all()
            ->where('user_id', 'id', Auth::id());
        return response()->json($all);
    }

    public function getAllApplications()
    {
        $all = DB::table('applications')
            ->select('*', 'organizations.name', 'organizations.status', 'users.name as user_name', 'users.email')
            ->join('organizations', 'organizations.id', '=', 'applications.organization_id')
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->where('organizations.status', '=', '0')
            ->get();
        return response()->json($all);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $org = DB::table('applications')
                ->select('*')
                ->join('organizations', 'organizations.id', '=', 'applications.organization_id')
                ->where('applications.id', '=', $id)
                ->first();

            File::deleteDirectory(public_path("files/application/" . $org->name));

            $delete = DB::table('applications')
                ->where('id', '=', $id)
                ->delete();

            $delfromorg = DB::table('organizations')
                ->where('id', '=', $org->id)
                ->delete();

            if ($delete != 0) {
                return $delete;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
