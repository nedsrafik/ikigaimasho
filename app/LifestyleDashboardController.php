<?php

namespace App\Http\Controllers;

use App\Models\LifestyleData;
use App\Models\StressAssessment;

class LifestyleDashboardController extends Controller
{
    public function index()
    {
        // Retrieve the logged-in user's lifestyle records
        $records = LifestyleData::where('user_id', auth()->id())
            ->orderBy('record_date', 'asc')
            ->get();

        // Get latest lifestyle record
        $latest = $records->last();

        // Calculate lifestyle statistics
        $averageSleep = round($records->avg('sleep_hours') ?? 0, 1);

        $averageScreenTime = round(
            $records->avg('screen_time_hours') ?? 0, 1
        );

        $averageStudy = round(
            $records->avg('study_hours') ?? 0, 1
        );

        $totalExercise = $records->sum('exercise_minutes');

        // Retrieve PSS-10 assessment records
        $assessments = StressAssessment::where('user_id', auth()->id())
            ->orderBy('assessment_date', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $latestAssessment = $assessments->last();

        // Send all data to analysis.blade.php
        return view('lifestyle.analysis', compact(
            'records',
            'latest',
            'averageSleep',
            'averageScreenTime',
            'averageStudy',
            'totalExercise',
            'assessments',
            'latestAssessment'
        ));
    }
}
