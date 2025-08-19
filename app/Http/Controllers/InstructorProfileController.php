<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InstructorProfileController extends Controller
{
    public function show(User $user)
    {
        // Pastikan user yang diakses adalah seorang instruktur
        if ($user->role !== 'instructor') {
            abort(404);
        }

        // Ambil kursus milik instruktur tersebut
        $courses = $user->courses()->with('category')->latest()->get();

        return view('instructors.show', compact('user', 'courses'));
    }
}
