<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LifestyleData;

class LifestyleController extends Controller
{
    // Display lifestyle tracking page
    public function index()
    {
        // Get records belonging to the logged-in user
        $records = LifestyleData::where('user_id', auth()->id())
            ->orderBy('record_date', 'desc')
            ->get();

        // Send records to index.blade.php
        return view('lifestyle.index', compact('records'));
    }

    // Save daily lifestyle records
    public function store(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'record_date' => 'required|date|before_or_equal:today',
            'sleep_hours' => 'nullable|numeric|between:0,24',
            'screen_time_hours' => 'nullable|numeric|between:0,24',
            'study_hours' => 'nullable|numeric|between:0,24',
            'exercise_minutes' => 'nullable|numeric|between:0,1440',
        ]);

        // Save or update lifestyle data for the selected date
        LifestyleData::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'record_date' => $validated['record_date'],
            ],
            $validated
        );

        // Return to lifestyle tracking page
        return redirect()
            ->route('lifestyle.index')
            ->with('success', 'Lifestyle record saved successfully!');
    }
}

