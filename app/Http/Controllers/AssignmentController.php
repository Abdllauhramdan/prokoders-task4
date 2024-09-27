<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Services\AssignmentService;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller
{
    protected $assignmentService;

    public function __construct(AssignmentService $assignmentService)
    {
        $this->assignmentService = $assignmentService;
    }

    /**
     * List all assignments.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $assignments = $this->assignmentService->listAssignments($request->input('per_page', 10));
        return ApiResponseService::success($assignments, 'Assignments retrieved successfully.');
    }

    /**
     * Create a new assignment.
     *
     * @param AssignmentRequest $request
     * @return JsonResponse
     */
    public function store(AssignmentRequest $request)
    {
        $assignment = $this->assignmentService->createAssignment($request->validated());
        return ApiResponseService::success($assignment, 'Assignment created successfully.', 201);
    }

    /**
     * Get a specific assignment by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $assignment = $this->assignmentService->getAssignment($id);
        return ApiResponseService::success($assignment, 'Assignment retrieved successfully.');
    }

    /**
     * Update an assignment by ID.
     *
     * @param AssignmentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AssignmentRequest $request, $id)
    {
        $assignment = $this->assignmentService->updateAssignment($request->validated(), $id);
        return ApiResponseService::success($assignment, 'Assignment updated successfully.');
    }

    /**
     * Delete an assignment by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->assignmentService->deleteAssignment($id);
        return ApiResponseService::success(null, 'Assignment deleted successfully.');
    }
}
