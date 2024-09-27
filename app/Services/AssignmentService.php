<?php

namespace App\Services;

use App\Models\Assignment;
use Exception;
use Illuminate\Support\Facades\Log;

class AssignmentService
{
    public function createAssignment(array $data)
    {
        try {
            return Assignment::create($data);
        } catch (Exception $e) {
            Log::error('Error creating assignment: ' . $e->getMessage());
            throw new Exception('Error creating assignment.');
        }
    }

    public function getAssignment(int $id)
    {
        try {
            return Assignment::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Assignment not found.');
        }
    }
}
