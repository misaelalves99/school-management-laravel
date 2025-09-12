<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EnrollmentController;

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Recursos CRUD
Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('classrooms', ClassroomController::class);
Route::resource('enrollments', EnrollmentController::class);

// Redirecionamento fallback
Route::fallback(function () {
    return redirect()->route('home');
});
