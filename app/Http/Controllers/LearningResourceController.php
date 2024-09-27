<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLearningResourceRequest;
use App\Services\LearningResourceService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class LearningResourceController extends Controller
{
    protected $learningResourceService;

    public function __construct(LearningResourceService $learningResourceService)
    {
        $this->learningResourceService = $learningResourceService;
    }

    /**
     * Create a new learning resource.
     */
    public function store(StoreLearningResourceRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $learningResource = $this->learningResourceService->createLearningResource($data);
            return ApiResponseService::success($learningResource, 'Learning resource created successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage());
        }
    }

    /**
     * Get a specific learning resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $learningResource = $this->learningResourceService->getLearningResource($id);
            return ApiResponseService::success($learningResource, 'Learning resource retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Update a specific learning resource.
     */
    public function update(StoreLearningResourceRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        try {
            $learningResource = $this->learningResourceService->updateLearningResource($id, $data);
            return ApiResponseService::success($learningResource, 'Learning resource updated successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Delete a specific learning resource.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->learningResourceService->deleteLearningResource($id);
            return ApiResponseService::success(null, 'Learning resource deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }
}
