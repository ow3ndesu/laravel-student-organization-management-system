<?php

namespace App\Http\Controllers;

use App\Models\Renewal;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RenewalController extends Controller
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
            $Renewal = new Renewal();
            $Renewal->user_id = Auth::id();

            $validator = Validator::make($request->all(), [
                'renewalletter' => 'required|max:2048',
                'accomplishmentreport' => 'required|max:2048',
                'budgetaryreport' => 'required|max:2048'
            ]);

            if ($validator->fails()) {
                return $validator->errors()->all();
            } else {
                $renewalletter = $request->file('renewalletter');
                $accomplishmentreport = $request->file('accomplishmentreport');
                $budgetaryreport = $request->file('budgetaryreport');
                $letter_filename = $request->name . "_RenewalLetter." . $renewalletter->getClientOriginalExtension();
                $accreport_filename = $request->name . "_AccomplishmentReport." . $accomplishmentreport->getClientOriginalExtension();
                $budreport_filename = $request->name . "_BudgetaryReport." . $budgetaryreport->getClientOriginalExtension();
                $letter_extension = $renewalletter->getClientOriginalExtension();
                $accreport_extension = $accomplishmentreport->getClientOriginalExtension();
                $budreport_extension = $budgetaryreport->getClientOriginalExtension();
                $location = "files/renewal/" . $request->name;

                $renewalletter->move($location, $letter_filename);
                $accomplishmentreport->move($location, $accreport_filename);
                $budgetaryreport->move($location, $budreport_filename);

                $Renewal->organization_id = $request->organizationid;
                $Renewal->renewal_letter = $location . "/" . $letter_filename;
                $Renewal->accomplishment_report = $location . "/" . $accreport_filename;
                $Renewal->budgetary_report = $location . "/" . $budreport_filename;
                $Renewal->submitted_at = date('m/d/Y');
                $Renewal->save();

                if ($Renewal) {
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
     * @param  \App\Models\Renewal  $renewal
     * @return \Illuminate\Http\Response
     */
    public function show(Renewal $renewal)
    {
        //
    }

    public function getMyRenewal()
    {
        $all = Renewal::all()
            ->where('user_id', 'id', Auth::id());
        return response()->json($all);
    }

    public function getAllRenewals()
    {
        $all = DB::table('renewals')
            ->select('renewals.id', 'organizations.name', 'organizations.status', 'users.name as user_name', 'users.email')
            ->join('organizations', 'organizations.id', '=', 'renewals.organization_id')
            ->join('users', 'users.id', '=', 'renewals.user_id')
            // ->where('organizations.status', '=', '2')
            ->get();
        return response()->json($all);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Renewal  $renewal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = DB::table('renewals')
            ->select('renewals.id as renewal_id', 'renewals.user_id', 'renewals.organization_id', 'renewals.renewal_letter', 'renewals.accomplishment_report', 'renewals.budgetary_report', 'organizations.name', 'organizations.status', 'users.name as handler', 'users.email')
            ->join('organizations', 'organizations.id', '=', 'renewals.organization_id')
            ->join('users', 'users.id', '=', 'renewals.user_id')
            ->where('renewals.id', '=', $id)
            ->get();

        return response()->json($application);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Renewal  $renewal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modifiedat = date('m/d/Y');
        try {
            if ($request->from === "ADMIN") {
                $update = DB::table('renewals')
                    ->join('organizations', 'organizations.id', '=', 'renewals.organization_id')
                    ->where('renewals.id', $id)
                    ->update([
                        "renewals.administrator_id" => Auth::id(),
                        "renewals.modified_at" => $modifiedat,
                        "organizations.status" => $request->status,
                        "organizations.updated_at" => Carbon::now()->toDateTimeString(),
                    ]);
                return $update;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Renewal  $renewal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $org = DB::table('renewals')
                ->select('*')
                ->join('organizations', 'organizations.id', '=', 'renewals.organization_id')
                ->where('renewals.id', '=', $id)
                ->first();

            File::deleteDirectory(public_path("files/renewal/" . $org->name));

            $delete = DB::table('renewals')
                ->where('id', '=', $id)
                ->delete();

            if ($delete != 0) {
                return $delete;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
