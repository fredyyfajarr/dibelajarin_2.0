<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Course $course)
    {
        // Cek apakah user sudah terdaftar sebelumnya untuk menghindari duplikat
        $isEnrolled = Enrollment::where('user_id', Auth::id())
                                ->where('course_id', $course->id)
                                ->exists();

        if ($isEnrolled) {
            return back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        // Buat entri baru di tabel enrollments
        Enrollment::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'course_id' => $course->id,
        ]);

       return back()->with('success', 'Selamat! Anda berhasil mendaftar kursus.');
    }
}
