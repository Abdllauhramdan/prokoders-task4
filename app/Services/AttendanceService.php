<?php

namespace App\Services;

use App\Models\Attendance;
use Exception;
use Illuminate\Support\Facades\Log;

class AttendanceService
{
    public function createAttendance(array $data)
    {
        try {
            return Attendance::create($data);
        } catch (Exception $e) {
            Log::error('Error creating attendance: ' . $e->getMessage());
            throw new Exception('Error creating attendance.');
        }
    }

    public function getAttendance(int $id)
    {
        try {
            return Attendance::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Attendance not found.');
        }
    }
}
