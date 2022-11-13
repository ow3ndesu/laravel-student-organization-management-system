<?php

namespace App\Http\Controllers;

use App\Models\ArchiveEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveEventController extends Controller
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
     * @param  \App\Models\ArchiveEvent  $archiveEvent
     * @return \Illuminate\Http\Response
     */
    public function show(ArchiveEvent $archiveEvent)
    {
        //
    }

    public function loadArchivedEvents() {
        $archivedEvents = ArchiveEvent::all();
        return response()->json($archivedEvents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArchiveEvent  $archiveEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchiveEvent $archiveEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArchiveEvent  $archiveEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchiveEvent $archiveEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchiveEvent  $archiveEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::insert("
                INSERT INTO events 
                SELECT ae.event_id, ae.user_id, ae.image, ae.name, ae.place, ae.date_time, ae.out, ae.description, ae.status, ae.event_created_at, ae.event_updated_at
                FROM archive_events ae
                WHERE ae.id = '$id'"
            );

            $delete = DB::table('archive_events')
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
