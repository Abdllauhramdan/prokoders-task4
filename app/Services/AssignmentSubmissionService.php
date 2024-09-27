<?php

namespace App\Services;

use App\Models\AssignmentSubmission;
use Exception;
use Illuminate\Support\Facades\Log;

class AssignmentSubmissionService
{
    public function createSubmission(array $data)
    {
        try {
            return AssignmentSubmission::create($data);
        } catch (Exception $e) {
            Log::error('Error creating submission: ' . $e->getMessage());
            throw new Exception('Error creating submission.');
        }
    }

    public function getSubmission(int $id)
    {
        try {
            return AssignmentSubmission::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Submission not found.');
        }
    }

    public function updateSubmission(array $data, int $id)
    {
        try {
            $submission = AssignmentSubmission::findOrFail($id);
            $submission->update(array_filter($data));
            return $submission;
        } catch (Exception $e) {
            throw new Exception('Error updating submission.');
        }
    }

    public function deleteSubmission(int $id)
    {
        try {
            $submission = AssignmentSubmission::findOrFail($id);
            $submission->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting submission.');
        }
    }
}
