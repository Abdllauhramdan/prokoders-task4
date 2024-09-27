<?php

namespace App\Services;

use App\Models\LearningResource;
use App\Http\Requests\LearningResourceRequest;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Log;

class LearningResourceService
{
    public function createLearningResource(LearningResourceRequest $request)
    {
        try {
            // Store the file
            $path = $request->file('file')->store('learning_resources');

            // Create the resource record
            return LearningResource::create([
                'title' => $request->validated()['title'],
                'file_path' => $path,
                'subject_id' => $request->validated()['subject_id'],
            ]);
        } catch (Exception $e) {
            Log::error('Error creating learning resource: ' . $e->getMessage());
            throw new Exception('Error creating learning resource.');
        }
    }

    public function getLearningResource(int $id)
    {
        try {
            return LearningResource::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Learning resource not found.');
        }
    }

    public function downloadLearningResource(int $id)
    {
        try {
            $resource = LearningResource::findOrFail($id);
            return Storage::download($resource->file_path);
        } catch (Exception $e) {
            throw new Exception('Error downloading resource.');
        }
    }

    public function deleteLearningResource($id)
    {
        try {
            $resource = LearningResource::findOrFail($id);
            Storage::delete($resource->file_path);
            $resource->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting learning resource.');
        }
    }
}
