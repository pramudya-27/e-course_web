<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Harus login
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) {
                return redirect('/')->with('error', 'You do not have admin access.');
            }
            return $next($request);
        });
    }

    // Menampilkan daftar semua user (non-admin)
    public function index()
    {
        $users = User::where('is_admin', false)->get();
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false, // Pastikan user baru bukan admin
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Menampilkan form untuk mengedit user
    public function edit(User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('users.index')->with('error', 'Cannot edit admin users!');
        }
        return view('users.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('users.index')->with('error', 'Cannot edit admin users!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Menghapus user
    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('users.index')->with('error', 'Cannot delete admin users!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}