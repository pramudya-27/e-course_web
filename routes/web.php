<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;

// Route untuk tampilan utama (publik)
Route::get('/', function () {
    $courses = \App\Models\Course::all(); // Ambil semua kursus
    return view('welcome', compact('courses'));
})->name('home');



// Route untuk admin (dengan middleware auth dan admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/admin/courses', CourseController::class);
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::resource('/admin/users', UserController::class);

    Route::get('/admin/courses/{course}/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/admin/courses/{course}/registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/admin/courses/{course}/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/courses/{course}/registrations', [AdminController::class, 'showRegistrations'])->name('registrations.index');
    Route::delete('/admin/courses/{course}/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');

    Route::get('/admin/purchase_requests', [App\Http\Controllers\Admin\PurchaseRequestController::class, 'index'])->name('admin.purchase_requests.index');
    Route::post('/admin/purchase_requests/{purchaseRequest}/approve', [App\Http\Controllers\Admin\PurchaseRequestController::class, 'approve'])->name('admin.purchase_requests.approve');
    Route::post('/admin/purchase_requests/{purchaseRequest}/reject', [App\Http\Controllers\Admin\PurchaseRequestController::class, 'reject'])->name('admin.purchase_requests.reject');
    Route::delete('/purchase-requests/{purchaseRequest}', [App\Http\Controllers\Admin\PurchaseRequestController::class, 'destroy'])->name('admin.purchase_requests.destroy');
    Route::delete('/purchase-requests', [App\Http\Controllers\Admin\PurchaseRequestController::class, 'destroyAll'])->name('admin.purchase_requests.destroyAll');

    Route::get('/admin/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('admin.messages.destroy');
});

Route::post('/courses/{course}/enroll', [RegistrationController::class, 'enroll'])->name('courses.enroll');
Route::post('/courses/{course}/unenroll', [RegistrationController::class, 'unenroll'])->name('courses.unenroll');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/courses/{course}/enroll', [PurchaseRequestController::class, 'store'])->name('courses.enroll');
Route::post('/courses/{course}/confirm', [RegistrationController::class, 'confirm'])->name('courses.confirm');



Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::post('/courses/{course}/rate', [App\Http\Controllers\CourseRatingController::class, 'store'])->middleware('auth')->name('courses.rate');

// Route autentikasi (dari Laravel UI)
Auth::routes();
