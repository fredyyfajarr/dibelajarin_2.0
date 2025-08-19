<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        $course = $lesson->course;

        // --- LOGIKA KEAMANAN BARU ---
        $isEnrolled = $user->enrolledCourses->contains($course);
        $isInstructor = $course->user_id === $user->id;

        // Tolak jika user BUKAN siswa terdaftar DAN BUKAN instruktur pemilik
        if (!$isEnrolled && !$isInstructor) {
            abort(403, 'Anda tidak memiliki izin untuk berkomentar di sini.');
        }
        // --- AKHIR LOGIKA KEAMANAN ---

        $request->validate(['content' => 'required|string']);

        $lesson->comments()->create([
            'user_id' => $user->id,
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
