<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses()
                            ->with('category')
                            ->withCount('lessons')
                            ->get();
        $completedLessons = $user->completedLessons;

        foreach ($enrolledCourses as $course) {
            $completedCount = $completedLessons->where('course_id', $course->id)->count();
            $totalLessons = $course->lessons_count; // Menggunakan hasil dari withCount

            $course->progress = ($totalLessons > 0) ? ($completedCount / $totalLessons) * 100 : 0;
            $course->completed_lessons_count = $completedCount;
        }

        return view('dashboard', compact('enrolledCourses'));
    }
}
