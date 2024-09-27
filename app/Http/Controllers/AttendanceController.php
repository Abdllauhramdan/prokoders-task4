<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    

public function store(StoreAttendanceRequest $request): JsonResponse
{
    $data = $request->validated();

    try {
        $attendance = $this->attendanceService->createAttendance($data);
        return ApiResponseService::success($attendance, 'Attendance recorded successfully');
    } catch (\Exception $e) {
        return ApiResponseService::error($e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
