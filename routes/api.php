<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /**
     * Auth Routes
     *
     * These routes handle user authentication, including login, registration, and logout.
    */
    Route::controller(AuthController::class)->group(function () {
        /**
         * Login Route
         *
         * @method POST
         * @route /v1/login
         * @desc Authenticates a user and returns a JWT token.
         */
        Route::post('login', 'login');

        /**
         * Register Route
         *
         * @method POST
         * @route /v1/register
         * @desc Registers a new user and returns a JWT token.
         */
        Route::post('register', 'register');

        /**
         * Logout Route
         *
         * @method POST
         * @route /v1/logout
         * @desc Logs out the authenticated user.
         * @middleware auth:api
         */
        Route::post('logout', 'logout')->middleware('auth:api');
    });

    /**
     * Author Management Routes
     *
     * These routes handle author management operations, such as creating, updating, and deleting authors.
     * The routes are protected and require authentication using the 'auth:api' middleware, except for 'index' and 'show'.
     */
    Route::apiResource('authors', AuthorController::class)
        ->middleware(['auth:api'])
        ->except(['index', 'show']); // 'index' and 'show' are publicly accessible routes, no auth required

    /**
     * Student Management Routes
     *
     * These routes manage student operations like registering, updating, and deleting students.
     * Authentication is required for all routes except for 'index' and 'show'.
     */
    Route::apiResource('students', StudentController::class)
        ->middleware(['auth:api'])
        ->except(['index', 'show']); // 'index' and 'show' are publicly accessible routes, no auth required

    /**
     * Teacher Management Routes
     *
     * These routes manage teacher operations like registering, updating, and deleting teachers.
     * Authentication is required for all routes except for 'index' and 'show'.
     */
    Route::apiResource('teachers', TeacherController::class)
        ->middleware(['auth:api'])
        ->except(['index', 'show']); // 'index' and 'show' are publicly accessible routes, no auth required

    /**
     * Course Management Routes
     *
     * These routes manage courses, allowing teachers to create, update, and delete courses.
     * The 'index' and 'show' routes are publicly accessible to view the available courses.
     */
    Route::apiResource('courses', CourseController::class)
        ->middleware(['auth:api'])
        ->except(['index', 'show']); // 'index' and 'show' are publicly accessible routes, no auth required

    /**
     * Exam Management Routes
     *
     * These routes handle the creation, updating, and deletion of exams.
     * Authentication is required for all operations.
     */
    Route::apiResource('exams', ExamController::class)
        ->middleware(['auth:api']);

    /**
     * Assignment Management Routes
     *
     * These routes handle the creation, updating, and deletion of assignments.
     * Authentication is required for all operations.
     */
    Route::apiResource('assignments', AssignmentController::class)
        ->middleware(['auth:api']);

    /**
     * Attendance Management Routes
     *
     * These routes manage student attendance.
     * Authentication is required for recording and updating attendance.
     */
    Route::apiResource('attendances', AttendanceController::class)
        ->middleware(['auth:api']);

    /**
     * Evaluation Management Routes
     *
     * These routes manage evaluations for students, allowing teachers to evaluate student performance.
     * Authentication is required for all operations.
     */
    Route::apiResource('evaluations', EvaluationController::class)
        ->middleware(['auth:api']);

});
