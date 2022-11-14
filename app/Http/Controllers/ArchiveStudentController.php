<?php

namespace App\Http\Controllers;

use App\Models\ArchiveStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveStudentController extends Controller
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
     * @param  \App\Models\ArchiveStudent  $archiveStudent
     * @return \Illuminate\Http\Response
     */
    public function show(ArchiveStudent $archiveStudent)
    {
        //
    }

    public function loadArchivedStudents() {
        $archivedStudents = ArchiveStudent::all();
        return response()->json($archivedStudents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArchiveStudent  $archiveStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchiveStudent $archiveStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArchiveStudent  $archiveStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchiveStudent $archiveStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchiveStudent  $archiveStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::insert("
                INSERT INTO users 
                SELECT ass.user_id, ass.name, ass.email, ass.email_verified_at, ass.password, ass.type, ass.remember_token, ass.student_updated_at, ass.student_created_at
                FROM archive_students ass
                WHERE ass.id = '$id'"
            );

            $delete = DB::table('archive_students')
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
