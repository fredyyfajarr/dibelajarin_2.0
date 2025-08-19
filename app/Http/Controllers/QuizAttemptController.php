<?php
namespace App\Http\Controllers;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function show(QuizAttempt $attempt)
    {
        // Keamanan: pastikan hanya user yang bersangkutan yang bisa melihat hasilnya
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }
        return view('quizzes.result', compact('attempt'));
    }
}
