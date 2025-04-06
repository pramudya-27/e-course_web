<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function confirm(Course $course)
    {
        $user = Auth::user();

        // Cek apakah ada permintaan pembelian yang disetujui
        $purchaseRequest = \App\Models\PurchaseRequest::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'approved')
            ->first();

        if (!$purchaseRequest) {
            return redirect()->route('home')->with('error', 'Anda belum disetujui untuk kursus ini.');
        }

        // Cek apakah sudah terdaftar
        $isEnrolled = DB::table('registrations')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($isEnrolled) {
            return redirect()->route('home')->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        // Daftarkan pengguna ke kursus
        DB::table('registrations')->insert([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Anda berhasil terdaftar di kursus!');
    }

    public function enroll(Course $course)
    {
        $user = Auth::user();

        // Cek apakah pengguna sudah terdaftar menggunakan query manual
        $isEnrolled = DB::table('registrations')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($isEnrolled) {
            return redirect()->route('home')->with('info', 'You are already enrolled in this course.');
        }

        // Tambahkan pendaftaran baru
        DB::table('registrations')->insert([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Successfully enrolled in the course!');
    }

    public function unenroll(Course $course)
    {
        $user = Auth::user();

        $isEnrolled = DB::table('registrations')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('home')->with('info', 'Anda belum terdaftar di kursus ini.');
        }

        DB::table('registrations')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->delete();

        return redirect()->route('home')->with('success', 'Berhasil membatalkan pendaftaran dari kursus!');
    }

    public function index(Course $course)
    {
        $registrations = DB::table('registrations')
        ->where('course_id', $course->id)
        ->join('users', 'registrations.user_id', '=', 'users.id')
        ->select('users.name', 'registrations.created_at')
        ->get();

        return view('admin.registrations.index', compact('course', 'registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $users = User::where('is_admin', false)->get(); // Hanya user biasa, bukan admin
        return view('registrations.create', compact('course', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Cek apakah peserta sudah terdaftar
        if ($course->registrations()->where('user_id', $request->user_id)->exists()) {
            return redirect()->route('registrations.index', $course)->with('error', 'User already registered!');
        }

        Registration::create([
            'course_id' => $course->id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('registrations.index', $course)->with('success', 'Participant added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Registration $registration)
    {
        $registration->delete();
        return redirect()->route('registrations.index', $course)->with('success', 'Participant removed!');
    }
}
