<?php

namespace App\Http\Controllers;

use App\Models\ArchiveOrganization;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
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
            $organization = new Organization();
            $organization->userId = Auth::id();
            $organization->name = $request->name;
            $organization->status = '0';
            $organization->save();

            if ($organization) {
                return true;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    public function getAllOrganizations()
    {
        $organizations = DB::table('organizations')
            ->where('status', '=', '1')
            ->get();
        return response()->json($organizations);
    }

    public function getAllOrganizationsNonAuthor()
    {
        $organizations = DB::table('organizations')
            ->select('organizations.*', 'users.name as user_name')
            ->leftJoin('users', 'organizations.user_id', '=', 'users.id')
            ->get();
        return response()->json($organizations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organization = DB::table('organizations')
            ->select('organizations.id as organization_id', 'users.name as handler', 'organizations.name', 'organizations.status', 'applications.application_form', 'applications.advisers_commitment_form', 'renewals.renewal_letter', 'renewals.accomplishment_report', 'renewals.budgetary_report')
            ->leftJoin('users', 'users.id', '=', 'organizations.user_id')
            ->leftJoin('applications', 'applications.organization_id', '=', 'organizations.id')
            ->leftJoin('renewals', 'renewals.organization_id', '=', 'organizations.id')
            ->where('organizations.id', '=', $id)
            ->orderByDesc('organizations.created_at')
            ->limit(1)
            ->get();

        return response()->json($organization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modifiedat = date('m/d/Y');
        try {
            if ($request->from === "ADMIN") {
                $update = DB::table('organizations')
                    ->where('organizations.id', $id)
                    ->update([
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
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $organization  = DB::table('organization')
                ->select('*')
                ->where('id', '=', $id)
                ->first();

            $ArchiveOrganization = new ArchiveOrganization();
            $ArchiveOrganization->organization_id = $organization->id;
            $ArchiveOrganization->user_id = $organization->user_id;
            $ArchiveOrganization->status = $organization->status;
            $ArchiveOrganization->organization_created_at = $organization->created_at;
            $ArchiveOrganization->organization_updated_at = $organization->updated_at;
            $ArchiveOrganization->save();

            $delete = DB::table('organizations')
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
