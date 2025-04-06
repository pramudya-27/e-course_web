<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRatingController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $rating = CourseRating::updateOrCreate(
            ['user_id' => Auth::id(), 'course_id' => $course->id],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Rating berhasil disimpan!');
    }
}
