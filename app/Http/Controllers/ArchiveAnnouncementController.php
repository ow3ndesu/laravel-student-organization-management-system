<?php

namespace App\Http\Controllers;

use App\Models\ArchiveAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveAnnouncementController extends Controller
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
     * @param  \App\Models\ArchiveAnnouncement  $archiveAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function show(ArchiveAnnouncement $archiveAnnouncement)
    {
        //
    }

    public function loadArchivedAnnouncements() {
        $archivedAnnouncements = ArchiveAnnouncement::all();
        return response()->json($archivedAnnouncements);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArchiveAnnouncement  $archiveAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchiveAnnouncement $archiveAnnouncement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArchiveAnnouncement  $archiveAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchiveAnnouncement $archiveAnnouncement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchiveAnnouncement  $archiveAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::insert("
                INSERT INTO announcements 
                SELECT aa.announcement_id, aa.user_id, aa.title, aa.announcement, aa.status, aa.announcement_created_at, aa.announcement_updated_at
                FROM archive_announcements aa
                WHERE aa.id = '$id'"
            );

            $delete = DB::table('archive_announcements')
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
