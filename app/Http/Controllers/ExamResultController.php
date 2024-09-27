<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamResultRequest;
use App\Services\ExamResultService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class ExamResultController extends Controller
{
    protected $examResultService;

    public function __construct(ExamResultService $examResultService)
    {
        $this->examResultService = $examResultService;
    }

    /**
     * Create a new exam result.
     */
    public function store(StoreExamResultRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $examResult = $this->examResultService->createExamResult($data);
            return ApiResponseService::success($examResult, 'Exam result created successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage());
        }
    }

    /**
     * Get a specific exam result.
     */
    public function show($id): JsonResponse
    {
        try {
            $examResult = $this->examResultService->getExamResult($id);
            return ApiResponseService::success($examResult, 'Exam result retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Update a specific exam result.
     */
    public function update(StoreExamResultRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        try {
            $examResult = $this->examResultService->updateExamResult($data, $id);
            return ApiResponseService::success($examResult, 'Exam result updated successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Delete a specific exam result.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->examResultService->deleteExamResult($id);
            return ApiResponseService::success(null, 'Exam result deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }
}
