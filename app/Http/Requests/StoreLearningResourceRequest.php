<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLearningResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048', // قبول فقط ملفات PDF بحجم أقصى 2MB
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title of the resource is required.',
            'file.required' => 'A file must be uploaded.',
            'file.mimes' => 'Only PDF files are allowed.',
            'file.max' => 'The file size must not exceed 2MB.',
        ];
    }
}
