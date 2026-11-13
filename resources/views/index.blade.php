
<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-3"
            style="color: #52745C;">
            PSS-10 Stress Assessment
        </h1>

        <p class="text-gray-600 mb-6">
            Think about your feelings and thoughts during
            the last month. Choose how often you experienced
            each situation.
        </p>

<!-- PSS-10 Score Interpretation -->
<div class="bg-white p-6 rounded-xl shadow-sm mb-6">

    <h2 class="text-lg font-bold mb-3"
        style="color: #52745C;">
        Understanding Your PSS-10 Score
    </h2>

    <p class="text-gray-600 mb-4">
        The PSS-10 measures how stressful you perceive
        your experiences to be over the past month.
        Scores range from 0 to 40, with higher scores
        indicating greater perceived stress.
    </p>

    <div class="space-y-3">

        <div class="bg-green-50 border-l-4 border-green-500 p-3">
            <strong>0–13: Low Perceived Stress</strong>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-3">
            <strong>14–26: Moderate Perceived Stress</strong>
        </div>

        <div class="bg-red-50 border-l-4 border-red-500 p-3">
            <strong>27–40: High Perceived Stress</strong>
        </div>

    </div>

    <p class="text-sm text-gray-500 mt-4">
        These ranges are commonly used for general
        interpretation, but they are not official
        diagnostic cutoffs. The PSS-10 is not a
        medical diagnostic tool.
    </p>

</div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-5">
                Please answer all 10 questions. 
            </div>
        @endif

        @php
            // Temporary development questions.
            // Replace with the authorized official PSS-10 wording
            // before using this for research.
            $questions = [
                1 => 'Have you been upset because something happened unexpectedly?',
                2 => 'Have you felt unable to control the important things in your life?',
                3 => 'Have you felt nervous and “stressed”',
                4 => 'Have you felt confident about your ability to handle your personal problems? (reverse)',
                5 => 'Have you felt that things were going your way? (reverse)',
                6 => 'Have you found you could not cope with all the things you had to do?',
                7 => 'Have you been able to control irritations in your life? (reverse)',
                8 => 'Have you felt that you were on top of things? (reverse)',
                9 => 'Have you been angered because of things that were outside your control?',
                10 => 'Have you felt difficulties were piling up so high that you could not overcome them?',
            ];

            $options = [
                0 => 'Never',
                1 => 'Almost never',
                2 => 'Sometimes',
                3 => 'Fairly often',
                4 => 'Very often',
            ];
        @endphp

        <form action="{{ route('stress.store') }}"
              method="POST"
              class="space-y-5">

            @csrf

            @foreach($questions as $number => $question)

                <div class="bg-white p-6 rounded-xl shadow-sm">

                    <h2 class="font-semibold mb-4">
                        {{ $number }}. {{ $question }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-3">

                        @foreach($options as $value => $label)

                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio"
                                       name="q{{ $number }}"
                                       value="{{ $value }}"
                                       required
                                       @checked(old('q'.$number) !== null
                                           && (int) old('q'.$number) === $value)>

                                {{ $label }}
                            </label>

                        @endforeach

                    </div>
                </div>

            @endforeach

            <button type="submit"
                    class="text-white px-6 py-3 rounded-lg"
                    style="background-color: #52745C;">
                Submit Assessment
            </button>

        </form>

        <h2 class="text-xl font-bold mt-10 mb-4">
            Previous Assessments
        </h2>

        <div class="bg-white rounded-xl shadow-sm p-5">

            @forelse($assessments as $assessment)

                <div class="border-b py-3">
                    <p>
                        Date: {{ $assessment->assessment_date }}
                    </p>

                    <p class="font-semibold">
                        PSS-10 Score:
                        {{ $assessment->total_score }} / 40
                    </p>
                </div>

@php
    $score = $assessment->total_score;
@endphp

@if($score <= 13)
    <p class="text-green-700 font-semibold mt-2">
        Low Perceived Stress
    </p>
@elseif($score <= 26)
    <p class="text-yellow-700 font-semibold mt-2">
        Moderate Perceived Stress
    </p>
@else
    <p class="text-red-700 font-semibold mt-2">
        High Perceived Stress
    </p>
@endif


            @empty

                <p class="text-gray-500">
                    No assessments completed yet.
                </p>

            @endforelse

        </div>

    </div>
</x-app-layout>
