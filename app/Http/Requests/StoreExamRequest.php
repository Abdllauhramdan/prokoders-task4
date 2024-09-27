<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // يمكن تغييرها للتحكم في الصلاحيات
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'total_marks' => 'required|integer|min:0',
            'questions' => 'nullable|array',
            'questions.*.text' => 'required_with:questions|string|max:1000',
            'questions.*.marks' => 'required_with:questions|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The exam title is required.',
            'subject_id.required' => 'The subject is required.',
            'date.required' => 'The exam date is required.',
            'total_marks.required' => 'Total marks are required.',
            'questions.*.text.required_with' => 'Each question must have text.',
            'questions.*.marks.required_with' => 'Each question must have marks.',
        ];
    }
}
