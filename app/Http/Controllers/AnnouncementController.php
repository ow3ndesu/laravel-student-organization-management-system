<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\ArchiveAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
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
            if ($request->from !== 'ADMIN') {
                $Announcement = new Announcement();
                $Announcement->user_id = Auth::id();
                $Announcement->title = $request->title;
                $Announcement->announcement = $request->announcement;
                $Announcement->status = '0'; //This is to override the status check. Remove this line after full payment.
                $Announcement->save();

                if ($Announcement) {
                    return true;
                }
            } else {
                $Announcement = new Announcement();
                $Announcement->user_id = Auth::id();
                $Announcement->title = $request->title;
                $Announcement->announcement = $request->announcement;
                $Announcement->status = $request->status; //This is to override the status check. Remove this line after full payment.
                $Announcement->save();

                if ($Announcement) {
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
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getAllAnnouncements()
    {
        $all = DB::table('announcements')
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($all);
    }

    public function getAllAnnouncementsNonAuthor()
    {
        $all = DB::table('announcements')
            ->select('announcements.*', 'users.name as author', 'users.email')
            ->join('users', 'users.id', '=', 'announcements.user_id')
            ->get();
        return response()->json($all);
    }

    public function getAllActiveAnnouncements()
    {
        $active = Announcement::all()
            ->where('user_id', 'id', Auth::id())
            ->where('status', '=', '1');
        return response()->json($active);
    }

    public function getAllActiveAnnouncementsNonAuthor()
    {
        $all = DB::table('announcements')
            ->select('announcements.*', 'users.name as author', 'users.email')
            ->join('users', 'users.id', '=', 'announcements.user_id')
            ->where('status', '=', '1')
            ->get();
        return response()->json($all);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = DB::table('announcements')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return response()->json($announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->from !== "ADMIN") {
                $update = DB::table('announcements')
                    ->where('id', $id)
                    ->update([
                        "title" => $request->title,
                        "announcement" => $request->announcement,
                    ]);
                return $update;
            } else {
                $update = DB::table('announcements')
                    ->where('id', $id)
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
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $announcement  = DB::table('announcements')
                ->select('*')
                ->where('id', '=', $id)
                ->first();

            $AnnouncementArchive = new ArchiveAnnouncement();
            $AnnouncementArchive->announcement_id = $announcement->id;
            $AnnouncementArchive->user_id = $announcement->user_id;
            $AnnouncementArchive->title = $announcement->title;
            $AnnouncementArchive->announcement = $announcement->announcement;
            $AnnouncementArchive->status = $announcement->status;
            $AnnouncementArchive->announcement_created_at = $announcement->created_at;
            $AnnouncementArchive->announcement_updated_at = $announcement->updated_at;
            $AnnouncementArchive->save();

            $delete = DB::table('announcements')
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
