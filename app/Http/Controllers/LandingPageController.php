<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 3 kursus terbaru, optimalkan dengan eager loading
        $latestCourses = Course::with(['instructor', 'category'])
                                ->latest()
                                ->take(3)
                                ->get();

        return view('welcome', compact('latestCourses'));
    }
}
