<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreEvaluationRequest extends FormRequest
// {
//     public function authorize(): bool
//     {
//         return true;
//     }

//     public function rules(): array
//     {
//         return [
//             'student_id' => 'required|exists:students,id',
//             'teacher_id' => 'required|exists:teachers,id',
//             'score' => 'required|integer|min:0|max:100',
//             'comments' => 'nullable|string|max:1000',
//         ];
//     }

//     public function messages()
//     {
//         return [
//             'student_id.required' => 'The student ID is required.',
//             'teacher_id.required' => 'The teacher ID is required.',
//             'score.required' => 'The score is required.',
//             'score.min' => 'The score must be at least 0.',
//             'score.max' => 'The score must not exceed 100.',
//         ];
//     }
// }
