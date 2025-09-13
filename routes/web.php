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
Route::get('students/{student}/delete', [StudentController::class, 'delete'])
     ->name('students.delete');

Route::resource('teachers', TeacherController::class);
Route::get('teachers/{teacher}/delete', [TeacherController::class, 'delete'])
     ->name('teachers.delete');

Route::resource('subjects', SubjectController::class);
Route::get('subjects/{subject}/delete', [SubjectController::class, 'delete'])
     ->name('subjects.delete');

Route::resource('classrooms', ClassroomController::class);
Route::get('classrooms/{classroom}/delete', [ClassRoomController::class, 'delete'])
     ->name('classrooms.delete');

Route::resource('enrollments', EnrollmentController::class);
Route::get('enrollments/{enrollment}/delete', [EnrollmentController::class, 'delete'])
     ->name('enrollments.delete');

// Redirecionamento fallback
Route::fallback(function () {
    return redirect()->route('home');
});
