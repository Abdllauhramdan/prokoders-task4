<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentSubmissionRequest;
use App\Services\AssignmentSubmissionService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class AssignmentSubmissionController extends Controller
{
    protected $assignmentSubmissionService;

    public function __construct(AssignmentSubmissionService $assignmentSubmissionService)
    {
        $this->assignmentSubmissionService = $assignmentSubmissionService;
    }

    /**
     * Create a new assignment submission.
     */
    public function store(StoreAssignmentSubmissionRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $submission = $this->assignmentSubmissionService->createSubmission($data);
            return ApiResponseService::success($submission, 'Assignment submitted successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage());
        }
    }

    /**
     * Get a specific assignment submission.
     */
    public function show($id): JsonResponse
    {
        try {
            $submission = $this->assignmentSubmissionService->getSubmission($id);
            return ApiResponseService::success($submission, 'Assignment submission retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Update a specific assignment submission.
     */
    public function update(StoreAssignmentSubmissionRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        try {
            $submission = $this->assignmentSubmissionService->updateSubmission($data, $id);
            return ApiResponseService::success($submission, 'Assignment submission updated successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }

    /**
     * Delete a specific assignment submission.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->assignmentSubmissionService->deleteSubmission($id);
            return ApiResponseService::success(null, 'Assignment submission deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 404);
        }
    }
}
