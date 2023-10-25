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
        $pointsType = $request->input('points_type'); // 'normal', 'committee', 'university_level', 'national_level', 'international_level'

        $points = [
            'normal' => 10,
            'committee' => 20,
            'university_level' => 30,
            'national_level' => 40,
            'international_level' => 50,
        ];

        if (array_key_exists($pointsType, $points)) {
            $student = StudentList::where('student_id', $studentId)->first();

            if ($student) {
                $pointsToAdd = $points[$pointsType];

                // Add points to the student
                $student->points += $pointsToAdd;
                $student->save();

                return response()->json(['success' => true, 'message' => 'Points saved successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Student not found']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid points type']);
        }
    }

    /**
     * Remove points for a student.
     */
    public function removePoints(Request $request)
    {
        $studentId = $request->input('student_id');
        $pointsType = $request->input('points_type'); // 'normal', 'committee', 'university_level', 'national_level', 'international_level'

        $points = [
            'normal' => 10,
            'committee' => 20,
            'university_level' => 30,
            'national_level' => 40,
            'international_level' => 50,
        ];

        if (array_key_exists($pointsType, $points)) {
            $student = StudentList::where('student_id', $studentId)->first();

            if ($student) {
                $pointsToRemove = $points[$pointsType];

                // Remove points from the student
                $student->points = max(0, $student->points - $pointsToRemove);
                $student->save();

                return response()->json(['success' => true, 'message' => 'Points removed successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Student not found']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid points type']);
        }
    }
}
