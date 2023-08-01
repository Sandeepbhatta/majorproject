<?php

// app/Http/Controllers/AttendanceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

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

        $attendance = Attendance::create($request->all());

        
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

