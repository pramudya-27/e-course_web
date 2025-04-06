<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Jika query ada, cari kursus berdasarkan judul atau deskripsi
        $courses = $query
            ? Course::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->get()
            : Course::all();

        return view('search', compact('courses', 'query'));
    }
}