<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Services\ExamService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    /**
     * Create a new exam with questions.
     */
   
public function store(StoreExamRequest $request): JsonResponse
{
    $data = $request->validated(); // استخدم البيانات بعد التحقق من صحتها

    try {
        $exam = $this->examService->createExam($data);
        return ApiResponseService::success($exam, 'Exam created successfully');
    } catch (\Exception $e) {
        return ApiResponseService::error($e->getMessage());
    }
}

    /**
     * Get a specific exam with questions.
     */
    public function show($id): JsonResponse
    {
        try {
            $exam = $this->examService->getExam($id);
            return ApiResponseService::success($exam, 'Exam retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Update a specific exam with questions.
     */
    public function update(StoreExamRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        try {
            $exam = $this->examService->updateExam($id, $data);
            return ApiResponseService::success($exam, 'Exam updated successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Delete a specific exam.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->examService->deleteExam($id);
            return ApiResponseService::success(null, 'Exam deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }
}
