
<x-app-layout>

<style>
    .lifestyle-summary-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        width: 100%;
    }

    .lifestyle-summary-grid > div {
        min-width: 0;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    }

    .lifestyle-summary-grid h3 {
        color: #52745C;
        font-size: 24px;
        font-weight: bold;
    }

    .lifestyle-summary-grid p {
        margin-top: 8px;
    }

    /* Adjust layout for very small screens */
    @media (max-width: 480px) {
        .lifestyle-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


    <div class="max-w-6xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-6">
            My Lifestyle Dashboard
        </h1>

        <a href="{{ route('lifestyle.index') }}"
           class="text-indigo-600 underline">
            Add Lifestyle Record
        </a>
        
    
<!-- PSS-10 Assessment Summary -->
<div class="bg-white rounded-xl shadow-sm p-6 mt-8">

    <h2 class="text-xl font-bold mb-4"
        style="color: #52745C;">
        My Perceived Stress
    </h2>

    @if($latestAssessment)

        @php
            $score = $latestAssessment->total_score;

            if ($score <= 13) {
                $category = 'Low';
                $color = 'text-green-700';
            } elseif ($score <= 26) {
                $category = 'Moderate';
                $color = 'text-yellow-700';
            } else {
                $category = 'High';
                $color = 'text-red-700';
            }
        @endphp

        <p class="text-gray-500">
            Latest PSS-10 Score
        </p>

        <h3 class="text-3xl font-bold mt-2">
            {{ $score }} / 40
        </h3>

        <p class="font-semibold mt-2 {{ $color }}">
            {{ $category }} Perceived Stress
        </p>

        <p class="text-sm text-gray-500 mt-4">
            These categories are descriptive, not
            clinical diagnostic thresholds.
        </p>

    @else

        <p class="text-gray-500">
            No stress assessment completed yet.
        </p>

        <a href="{{ route('stress.index') }}"
           class="inline-block mt-4 text-green-700 underline">
            Complete PSS-10 Assessment
        </a>

    @endif

</div>

<!-- PSS-10 Trend Chart -->
<div class="bg-white rounded-xl shadow-sm p-6 mt-8">

    <h2 class="text-xl font-bold mb-4"
        style="color: #52745C;">
        Perceived Stress Trend
    </h2>

    <div class="relative h-80">
        <canvas id="stressChart"></canvas>
    </div>

</div>


        @if($latest)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">

                @foreach([
                    'Sleep Hours' => $latest->sleep_hours,
                    'Screen Time' => $latest->screen_time_hours,
                    'Study Hours' => $latest->study_hours,
                    'Exercise Minutes' => $latest->exercise_minutes
                ] as $label => $value)

                    <div class="bg-white p-5 rounded-lg shadow">
                        <p class="text-gray-500">{{ $label }}</p>
                        <h2 class="text-2xl font-bold">
                            {{ $value ?? '-' }}
                        </h2>
                    </div>

                @endforeach

            </div>
        @else
            <p class="mt-6 text-gray-600">
                No lifestyle records yet.
                Please add your first record.
            </p>
        @endif


<!-- Lifestyle Analytics Summary -->
<div class="mt-8">

    <h2 class="text-xl font-bold mb-2"
        style="color: #52745C;">
        Lifestyle Analytics Summary
    </h2>

    <p class="text-gray-500 mb-5">
        Overview of your recorded lifestyle activities.
    </p>

    <!-- 2 x 2 Card Layout -->
  <div class="lifestyle-summary-grid">

        <!-- Average Sleep -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="bg-green-50 rounded-lg p-3 w-fit mb-3">
                <i data-lucide="moon"
                   class="w-6 h-6 text-green-800"></i>
            </div>

            <p class="text-gray-500 text-sm">
                Average Sleep
            </p>

            <h3 class="text-2xl font-bold mt-2"
                style="color: #52745C;">
                {{ $averageSleep }}
                <span class="text-sm font-normal">hours</span>
            </h3>
        </div>

        <!-- Average Screen Time -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="bg-green-50 rounded-lg p-3 w-fit mb-3">
                <i data-lucide="monitor"
                   class="w-6 h-6 text-green-800"></i>
            </div>

            <p class="text-gray-500 text-sm">
                Average Screen Time
            </p>

            <h3 class="text-2xl font-bold mt-2"
                style="color: #52745C;">
                {{ $averageScreenTime }}
                <span class="text-sm font-normal">hours</span>
            </h3>
        </div>

        <!-- Average Study -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="bg-green-50 rounded-lg p-3 w-fit mb-3">
                <i data-lucide="book-open"
                   class="w-6 h-6 text-green-800"></i>
            </div>

            <p class="text-gray-500 text-sm">
                Average Study
            </p>

            <h3 class="text-2xl font-bold mt-2"
                style="color: #52745C;">
                {{ $averageStudy }}
                <span class="text-sm font-normal">hours</span>
            </h3>
        </div>

        <!-- Total Exercise -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="bg-green-50 rounded-lg p-3 w-fit mb-3">
                <i data-lucide="activity"
                   class="w-6 h-6 text-green-800"></i>
            </div>

            <p class="text-gray-500 text-sm">
                Total Exercise
            </p>

            <h3 class="text-2xl font-bold mt-2"
                style="color: #52745C;">
                {{ $totalExercise }}
                <span class="text-sm font-normal">minutes</span>
            </h3>
        </div>

    </div>
</div>


       


    </div>
</div>

        <div class="bg-white rounded-lg shadow p-6 mt-8">
            <h2 class="text-xl font-bold mb-4">
                Sleep and Screen Time Trends
            </h2>

            <div class="relative h-80">
                <canvas id="lifestyleChart"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const records = @json($records);

        const dates = records.map(record => record.record_date);

        const sleep = records.map(record => record.sleep_hours);
        const screen = records.map(record => record.screen_time_hours);

        new Chart(document.getElementById('lifestyleChart'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [
                    {
                        label: 'Sleep Hours',
                        data: sleep,
                        borderColor: '#6366f1',
                        tension: 0.3
                    },
                    {
                        label: 'Screen Time Hours',
                        data: screen,
                        borderColor: '#f59e0b',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Hours'
                        }
                    }
                }
            }

            
        });


// PSS-10 assessment records from Laravel
const assessments = @json($assessments);

const assessmentDates = assessments.map(
    item => item.assessment_date
);

const stressScores = assessments.map(
    item => item.total_score
);

// Create the PSS-10 trend chart
new Chart(document.getElementById('stressChart'), {
    type: 'line',
    data: {
        labels: assessmentDates,
        datasets: [{
            label: 'PSS-10 Score',
            data: stressScores,
            borderColor: '#52745C',
            backgroundColor: 'rgba(82, 116, 92, 0.15)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                min: 0,
                max: 40,
                title: {
                    display: true,
                    text: 'PSS-10 Score'
                }
            }
        }
    }
});

    </script>
    <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>

<script>
    lucide.createIcons();
</script>
</x-app-layout>
