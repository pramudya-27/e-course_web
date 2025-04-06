<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna yang login bisa mengakses
    }

    public function index()
{
    $requests = PurchaseRequest::with(['user', 'course'])->get();
    return view('admin.purchase_requests.index', compact('requests'));
}

public function store(Request $request, Course $course)
{
    $user = Auth::user();

    // Cek apakah ada permintaan untuk kursus ini
    $existing = PurchaseRequest::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->first();

    if ($existing) {
        if ($existing->status === 'rejected') {
            // Jika ditolak, hapus permintaan lama dan buat yang baru
            $existing->delete();
        } else {
            // Jika pending atau approved, beri tahu pengguna
            return redirect()->route('home')->with('info', 'Anda sudah memiliki permintaan untuk kursus ini.');
        }
    }

    // Buat permintaan pembelian baru
    PurchaseRequest::create([
        'user_id' => $user->id,
        'course_id' => $course->id,
        'status' => 'pending',
    ]);

    return redirect()->route('home')->with('success', 'Permintaan pembelian telah dikirim ke admin.');
    }
}