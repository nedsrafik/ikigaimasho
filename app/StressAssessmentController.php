<?php

namespace App\Http\Controllers;
use App\Models\StressAssessment;
use Illuminate\Http\Request;

class StressAssessmentController extends Controller
{
    public function index()
    {
        $assessments = StressAssessment::where(
            'user_id',
            auth()->id()
        )
        ->orderBy('assessment_date', 'desc')
        ->get();

        return view('stress.index', compact('assessments'));
    }

    public function store(Request $request)
    {
        $rules = [];

        for ($i = 1; $i <= 10; $i++) {
            $rules["q$i"] = 'required|integer|between:0,4';
        }

        $validated = $request->validate($rules);

        // PSS-10: reverse-score questions 4, 5, 7 and 8.
        $reverseItems = [4, 5, 7, 8];
        $totalScore = 0;

        for ($i = 1; $i <= 10; $i++) {
            $score = (int) $validated["q$i"];

            if (in_array($i, $reverseItems)) {
                $score = 4 - $score;
            }

            $totalScore += $score;
        }

        StressAssessment::create([
            'user_id' => auth()->id(),
            'assessment_date' => now()->toDateString(),
            ...$validated,
            'total_score' => $totalScore,
        ]);

        return redirect()
            ->route('stress.index')
            ->with('success', 'Your assessment was saved successfully!');
    }
}
