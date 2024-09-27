<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'present' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'The student ID is required.',
            'subject_id.required' => 'The subject ID is required.',
            'date.required' => 'The date is required.',
            'present.required' => 'Attendance status is required.',
        ];
    }
}
