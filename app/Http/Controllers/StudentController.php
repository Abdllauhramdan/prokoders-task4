<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Services\StudentService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $data = $request->validated();
        $student = $this->studentService->createStudent($data);

        return ApiResponseService::success($student, 'Student created successfully');
    }
}
