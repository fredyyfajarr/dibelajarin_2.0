<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    /**
     * Menampilkan halaman katalog yang berisi semua kursus.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk ditampilkan sebagai pilihan filter
        $categories = Category::all();

        // Mulai query builder
        $query = Course::query()->with('instructor', 'category');

        // Cek apakah ada request filter berdasarkan kategori
        if ($request->has('category') && $request->query('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->has('search') && $request->query('search')) {
        $searchTerm = $request->query('search');
        $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        // Eksekusi query dan ambil hasilnya
        $courses = $query->latest()->get();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        // Mengambil kursus dengan relasi instruktur dan pelajaran
        $course->load(['instructor', 'lessons']);
        return view('courses.show', compact('course'));
    }
}
