<?php

namespace App\Http\Controllers;

use App\Models\ArchiveOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveOrganizationController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArchiveOrganization  $archiveOrganization
     * @return \Illuminate\Http\Response
     */
    public function show(ArchiveOrganization $archiveOrganization)
    {
        //
    }

    public function loadArchivedOrganizations() {
        $archivedOrganizations = ArchiveOrganization::all();
        return response()->json($archivedOrganizations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArchiveOrganization  $archiveOrganization
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchiveOrganization $archiveOrganization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArchiveOrganization  $archiveOrganization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchiveOrganization $archiveOrganization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchiveOrganization  $archiveOrganization
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::insert("
                INSERT INTO organizations 
                SELECT ao.organization_id, ao.user_id, ao.name, ao.status, ao.organization_created_at, ao.organization_updated_at
                FROM archive_organizations ao
                WHERE ao.id = '$id'"
            );

            $delete = DB::table('archive_organizations')
                ->where('id', '=', $id)
                ->delete();

            $delete = 1;
            if ($delete != 0) {
                return $delete;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
