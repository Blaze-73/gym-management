<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Membership;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Check-in (create new attendance record)
     */
    public function checkIn(Request $request)
    {
        $user = $request->user();

        // Check if user has active membership
        $activeMembership = Membership::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        if (!$activeMembership) {
            return response()->json([
                'message' => 'No active membership found. Please purchase a membership first.'
            ], 403);
        }

        // Check if user is already checked in
        $existingCheckIn = Attendance::where('user_id', $user->id)
            ->whereNull('check_out')
            ->first();

        if ($existingCheckIn) {
            return response()->json([
                'message' => 'You are already checked in',
                'attendance' => $existingCheckIn
            ], 422);
        }

        // Create check-in record
        $attendance = Attendance::create([
            'user_id' => $user->id,
            'check_in' => now(),
        ]);

        return response()->json([
            'message' => 'Checked in successfully',
            'attendance' => $attendance
        ], 201);
    }

    /**
     * Check-out (update existing attendance record)
     */
    public function checkOut(Request $request)
    {
        $user = $request->user();

        // Find open check-in
        $attendance = Attendance::where('user_id', $user->id)
            ->whereNull('check_out')
            ->first();

        if (!$attendance) {
            return response()->json([
                'message' => 'No active check-in found'
            ], 422);
        }

        // Calculate duration
        $checkOut = now();
        $duration = $attendance->check_in->diffInMinutes($checkOut);

        // Update attendance
        $attendance->update([
            'check_out' => $checkOut,
            'duration_minutes' => $duration,
        ]);

        return response()->json([
            'message' => 'Checked out successfully',
            'attendance' => $attendance,
            'duration' => $this->formatDuration($duration)
        ]);
    }

    /**
     * Get user's attendance history
     */
    public function history(Request $request)
    {
        $user = $request->user();

        $attendances = Attendance::where('user_id', $user->id)
            ->orderBy('check_in', 'desc')
            ->paginate(20);

        // Calculate stats
        $stats = [
            'total_visits' => Attendance::where('user_id', $user->id)
                ->whereNotNull('check_out')
                ->count(),
            'total_time_minutes' => Attendance::where('user_id', $user->id)
                ->whereNotNull('check_out')
                ->sum('duration_minutes'),
            'this_month_visits' => Attendance::where('user_id', $user->id)
                ->whereMonth('check_in', now()->month)
                ->whereYear('check_in', now()->year)
                ->count(),
        ];

        $stats['total_time_formatted'] = $this->formatDuration($stats['total_time_minutes']);

        return response()->json([
            'attendances' => $attendances,
            'stats' => $stats
        ]);
    }

    /**
     * Get all attendances (admin only)
     */
    public function index(Request $request)
    {
        $query = Attendance::with('user');

        // Filter by date
        if ($request->has('date')) {
            $query->whereDate('check_in', $request->date);
        }

        // Filter by user
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $attendances = $query->orderBy('check_in', 'desc')->paginate(50);

        return response()->json($attendances);
    }

    /**
     * Get current active check-ins (who's in the gym now)
     */
    public function active()
    {
        $activeCheckIns = Attendance::with('user')
            ->whereNull('check_out')
            ->orderBy('check_in', 'desc')
            ->get();

        return response()->json([
            'active_count' => $activeCheckIns->count(),
            'active_users' => $activeCheckIns
        ]);
    }

    /**
     * Format duration in minutes to readable format
     */
    private function formatDuration($minutes)
    {
        if (!$minutes) return '0 minutes';

        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        if ($hours > 0) {
            return "{$hours}h {$mins}m";
        }
        return "{$mins}m";
    }
}