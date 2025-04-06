<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PurchaseRequest;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Course $course)
    {
        // Ambil data pendaftaran dengan relasi user
        $registrations = Registration::where('course_id', $course->id)
            ->with('user')
            ->get();

        // Ambil semua pengguna yang belum terdaftar di kursus ini
        $users = User::whereDoesntHave('registrations', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('admin.registrations.index', compact('course', 'registrations', 'users'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Cek apakah pengguna sudah terdaftar
        $isEnrolled = Registration::where('user_id', $request->user_id)
            ->where('course_id', $course->id)
            ->exists();

        if ($isEnrolled) {
            return redirect()->route('registrations.index', $course)
                ->with('error', 'User is already enrolled in this course.');
        }

        // Tambahkan pengguna ke pendaftaran
        Registration::create([
            'user_id' => $request->user_id,
            'course_id' => $course->id,
        ]);

        return redirect()->route('registrations.index', $course)
            ->with('success', 'User has been added to the course.');
    }

    public function destroy(Course $course, Registration $registration)
    {
        // Pastikan registration terkait dengan course yang benar
        if ($registration->course_id !== $course->id) {
            return redirect()->route('registrations.index', $course)
                ->with('error', 'Invalid registration.');
        }

        // Hapus purchase request terkait (jika ada)
        PurchaseRequest::where('user_id', $registration->user_id)
            ->where('course_id', $course->id)
            ->delete();

        // Hapus registration
        $registration->delete();

        return redirect()->route('registrations.index', $course)
            ->with('success', 'User has been removed from the course.');
    }
}