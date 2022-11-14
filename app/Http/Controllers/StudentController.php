<?php

namespace App\Http\Controllers;

use App\Models\ArchiveEvent;
use App\Models\ArchiveStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
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
            $student = DB::table('users')
                ->insert(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'type' => $request->type
                    ]
                );

            if ($student) {
                return $student;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getAllStudents()
    {
        $students = DB::table('users')
            ->select('*')
            ->where('type', '=', 'Student')
            ->get();

        if ($students) {
            return response()->json($students);
        }

        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = DB::table('users')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $update = DB::table('users')
                ->where('id', '=', $id)
                ->update([
                    "name" => $request->name,
                    "email" => $request->place,
                ]);

            return $update;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $student  = DB::table('users')
                ->select('*')
                ->where('id', '=', $id)
                ->first();

            $ArchiveStudent = new ArchiveStudent();
            $ArchiveStudent->user_id = $student->id;
            $ArchiveStudent->name = $student->name;
            $ArchiveStudent->email = $student->email;
            $ArchiveStudent->email_verified_at = $student->email_verified_at;
            $ArchiveStudent->password = $student->password;
            $ArchiveStudent->type = $student->type;
            $ArchiveStudent->remember_token = $student->remember_token;
            $ArchiveStudent->student_created_at = $student->created_at;
            $ArchiveStudent->student_updated_at = $student->updated_at;
            $ArchiveStudent->save();

            $delete = DB::table('users')
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
