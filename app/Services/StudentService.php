<?php

namespace App\Services;

use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class StudentService
{
    public function createStudent(array $data)
    {
        try {
            return Student::create($data);
        } catch (Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage());
            throw new Exception('Error creating student.');
        }
    }

    public function getStudent(int $id)
    {
        try {
            return Student::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Student not found.');
        }
    }

    public function updateStudent(array $data, int $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->update(array_filter($data));
            return $student;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Student not found.');
        }
    }

    public function deleteStudent(int $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Student not found.');
        }
    }
}
