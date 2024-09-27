<?php

namespace App\Services;

use App\Models\Exam;
use App\Http\Requests\ExamRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class ExamService
{
    public function createExam(ExamRequest $request)
    {
        try {
            $exam = Exam::create([
                'title' => $request->validated()['title'],
                'subject_id' => $request->validated()['subject_id'],
                'date' => $request->validated()['date'],
                'total_marks' => $request->validated()['total_marks'],
            ]);

            // Store questions if provided
            foreach ($request->validated()['questions'] as $question) {
                $exam->questions()->create($question);
            }

            return $exam;
        } catch (Exception $e) {
            Log::error('Error creating exam: ' . $e->getMessage());
            throw new Exception('Error creating exam.');
        }
    }

    public function getExam(int $id)
    {
        try {
            return Exam::with('questions')->findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Exam not found.');
        }
    }

    public function updateExam(ExamRequest $request, $id)
    {
        try {
            $exam = Exam::findOrFail($id);
            $exam->update($request->validated());

            // Update or create questions
            if (!empty($request->validated()['questions'])) {
                $exam->questions()->delete();
                foreach ($request->validated()['questions'] as $question) {
                    $exam->questions()->create($question);
                }
            }

            return $exam;
        } catch (Exception $e) {
            throw new Exception('Error updating exam.');
        }
    }

    public function deleteExam($id)
    {
        try {
            Exam::findOrFail($id)->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting exam.');
        }
    }
}
