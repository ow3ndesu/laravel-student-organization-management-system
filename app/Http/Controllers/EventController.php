<?php

namespace App\Http\Controllers;

use App\Models\ArchiveEvent;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
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
            $image = $request->file('image');
            $imagefilename = strtolower(str_replace(" ", "-", $request->name)) . "_event." . $image->getClientOriginalExtension();
            $location = "images/events/";
            $image->move($location, $imagefilename);

            $event = new Event();
            $event->user_id = Auth::id();
            $event->image = $location . $imagefilename;
            $event->name = $request->name;
            $event->place = $request->place;
            $event->date_time = $request->date_timein;
            $event->out = $request->date_timeout;
            $event->description = $request->description;
            $event->save();

            if ($event) {
                return true;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getAllEvents()
    {
        $all = DB::table('events')
            ->where('user_id', '=', Auth::id())
            ->get();
        return response()->json($all);
    }

    public function getEventsHistory()
    {
        $all = DB::table('events')
            ->select('*')
            ->where('status', '=', '1')
            ->get();
        return response()->json($all);
    }

    public function getAllEventsNonAuthor()
    {
        $all = DB::table('events')
            ->select('events.*', 'organizations.name as author', 'users.email')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->join('organizations', 'organizations.user_id', '=', 'users.id')
            ->get();
        return response()->json($all);
    }

    public function getAllActiveEvents()
    {
        $active = Event::all()
            ->where('user_id', 'id', Auth::id())
            ->where('status', '=', '1');
        return response()->json($active);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = DB::table('events')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->from !== "ADMIN") {
                $update = DB::table('events')
                    ->where('id', '=', $id)
                    ->update([
                        "name" => $request->name,
                        "place" => $request->place,
                        "date_time" => $request->date_timein,
                        "out" => $request->date_timeout,
                        "description" => $request->description,
                    ]);

                return $update;
            } else {
                $update = DB::table('events')
                    ->where('id', '=', $id)
                    ->update([
                        "status" => $request->status,
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $event  = DB::table('events')
                ->select('*')
                ->where('id', '=', $id)
                ->first();

            $ArchiveEvent = new ArchiveEvent();
            $ArchiveEvent->event_id = $event->id;
            $ArchiveEvent->user_id = $event->user_id;
            $ArchiveEvent->image = $event->image;
            $ArchiveEvent->name = $event->name;
            $ArchiveEvent->place = $event->place;
            $ArchiveEvent->date_time = $event->date_time;
            $ArchiveEvent->out = $event->out;
            $ArchiveEvent->description = $event->description;
            $ArchiveEvent->status = $event->status;
            $ArchiveEvent->event_created_at = $event->created_at;
            $ArchiveEvent->event_updated_at = $event->updated_at;
            $ArchiveEvent->save();

            $delete = DB::table('events')
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
