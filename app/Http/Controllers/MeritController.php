<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
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

        $points = ($pointsType == 'committee') ? 15 : 10;

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            $student->points += $points;
            $student->save();

            return response()->json(['success' => true, 'message' => 'Points saved successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }

    /**
     * Delete points for a student.
     */
    public function deletePoints(Request $request)
    {
        $studentId = $request->input('student_id');
        $pointsType = $request->input('points_type'); // 'normal' or 'committee'

        $points = ($pointsType == 'committee') ? 15 : 10;

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            $student->points -= $points;
            $student->save();

            return response()->json(['success' => true, 'message' => 'Points deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }

    /**
     * Retrieve points for a student.
     */
    public function retrievePoints(Request $request)
    {
        $studentId = $request->input('student_id');

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            return response()->json(['success' => true, 'data' => ['points' => $student->points]]);
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

        $points = ($pointsType == 'committee') ? 15 : 10;

        $student = StudentList::where('student_id', $studentId)->first();

        if ($student) {
            $student->points = max(0, $student->points - $points);
            $student->save();

            return response()->json(['success' => true, 'message' => 'Points removed successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    }
}
