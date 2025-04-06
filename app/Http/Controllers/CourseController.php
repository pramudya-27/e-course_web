<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->user_id = Auth::user()->id; 
        $course->price = $request->price;
        $course->thumbnail = $thumbnailPath ?? null;
        $course->theme_link = $request->theme_link;

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Kursus berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
{
    // Validasi data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|string',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Siapkan data untuk diperbarui
    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'duration' => $request->duration,
    ];

    // Jika ada thumbnail baru, hapus yang lama dan simpan yang baru
    if ($request->hasFile('thumbnail')) {
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $data['thumbnail'] = $thumbnailPath;
    }

    // Perbarui kursus
    $course->update($data);

    return redirect()->route('courses.index')->with('success', 'Kursus berhasil diperbarui');
}
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course) {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted!');
    }
}
