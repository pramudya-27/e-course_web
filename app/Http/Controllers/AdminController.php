<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan pengguna login
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) {
                return redirect('/')->with('error', 'You do not have admin access.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $recentCourses = Course::latest()->take(5)->get();
        $recentUsers = User::where('is_admin', false)->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'recentCourses', 'recentUsers'));
    }
}