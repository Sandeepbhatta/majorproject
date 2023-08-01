<?php

// app/Http/Controllers/AttendanceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Auth;
use App\Models\User;


class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendance.attendance', compact('attendances'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'companyname' => 'required|string',
            'role' => 'required|string',
            'present' => 'nullable|boolean',
        ]);

        // $attendance = Attendance::create($request->all());
        $user = Auth::guard('api')->user();
        
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }   // Create the attendance record with the user ID
        $attendance = $user->attendances()->create($request->all());
        return response()->json(['message' => 'Attendance recorded successfully', 'data' => $attendance], 201);


        
    }

    public function downloadCsv()
    {
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=attendance.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $attendances = Attendance::all();

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array('Name', 'Designation', 'Company Name', 'Role','Present'));

            foreach ($attendances as $attendance) {
                fputcsv($file, array($attendance->name, $attendance->designation, $attendance->companyname, $attendance->role,$attendance->present));
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

