<?php

namespace App\Services;

use App\Models\ExamResult;
use Exception;
use Illuminate\Support\Facades\Log;

class ExamResultService
{
    public function createExamResult(array $data)
    {
        try {
            return ExamResult::create($data);
        } catch (Exception $e) {
            Log::error('Error creating exam result: ' . $e->getMessage());
            throw new Exception('Error creating exam result.');
        }
    }

    public function getExamResult(int $id)
    {
        try {
            return ExamResult::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Exam result not found.');
        }
    }

    public function updateExamResult(array $data, int $id)
    {
        try {
            $examResult = ExamResult::findOrFail($id);
            $examResult->update(array_filter($data));
            return $examResult;
        } catch (Exception $e) {
            throw new Exception('Error updating exam result.');
        }
    }

    public function deleteExamResult(int $id)
    {
        try {
            $examResult = ExamResult::findOrFail($id);
            $examResult->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting exam result.');
        }
    }
}
