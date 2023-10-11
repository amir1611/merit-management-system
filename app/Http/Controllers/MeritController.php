<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use App\Models\Program; // Add this line
use Illuminate\Http\Request;

class MeritController extends Controller
{
    /**
     * Search for a student by student_id.
     */
    public function searchStudent(Request $request)
    {
        $studentId = $request->input('student_id');

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            return response()->json(['success' => true, 'data' => $student]);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }

    /**
     * Save points for a student.
     */
    public function savePoints(Request $request)
    {
        $studentId = $request->input('student_id');
        $pointsType = $request->input('points_type'); // 'normal' or 'committee'
        $programId = $request->input('program_id'); // Add this line

        $points = ($pointsType == 'committee') ? 15 : 10;

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            // Add points to the student
            $student->points += $points;
            $student->save();

            // Attach the program to the student
            $student->programs()->attach($programId);

            return response()->json(['success' => true, 'message' => 'Points saved successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }

    /**
     * Remove points for a student.
     */
    public function removePoints(Request $request)
    {
        $studentId = $request->input('student_id');
        $pointsType = $request->input('points_type'); // 'normal' or 'committee'
        $programId = $request->input('program_id'); // Add this line

        $points = ($pointsType == 'committee') ? 15 : 10;

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            // Remove points from the student
            $student->points = max(0, $student->points - $points);
            $student->save();

            // Detach the program from the student
            $student->programs()->detach($programId);

            return response()->json(['success' => true, 'message' => 'Points removed successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }
}
