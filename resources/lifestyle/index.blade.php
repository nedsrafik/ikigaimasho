

<x-app-layout>

<style>
    .lifestyle-page {
        background: #fff5d4;
        min-height: 100vh;
        padding: 30px 16px 60px;
    }

    .lifestyle-container {
        max-width: 650px;
        margin: 0 auto;
    }

    .lifestyle-heading {
        color: #364c3d;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .lifestyle-description {
        color: #77766d;
        margin-bottom: 25px;
    }

    .step-progress {
        display: flex;
        gap: 8px;
        margin-bottom: 30px;
    }

    .step-progress span {
        height: 7px;
        flex: 1;
        background: #e3e6c9;
        border-radius: 20px;
    }

    .step-progress span.active {
        background: #52745c;
    }

    .lifestyle-step {
        display: none;
    }

    .lifestyle-step.active {
        display: block;
    }

    .step-icon {
        font-size: 48px;
        text-align: center;
        margin-bottom: 20px;
    }

    .input-panel {
        background: #a4d2b7;
        padding: 35px 25px;
        border-radius: 20px;
        margin: 30px 0;
    }

    .time-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .time-field label {
        display: block;
        text-align: center;
        color: #315f48;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .time-field input {
        width: 100%;
        padding: 18px 10px;
        text-align: center;
        font-size: 24px;
        border: none;
        border-radius: 12px;
        background: #cbe8d5;
        color: #315f48;
    }

    .step-buttons {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .step-button {
        flex: 1;
        padding: 15px;
        border: none;
        border-radius: 30px;
        background: #f5c778;
        color: #58482e;
        font-weight: bold;
        cursor: pointer;
    }

    .back-button {
        background: #e4e7d4;
        color: #364c3d;
    }

    .record-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-top: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .error-message {
        color: #b91c1c;
        margin-bottom: 15px;
    }


/* Lifestyle step illustrations */
.step-illustration {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 230px;
    margin: 15px auto 25px;
}

.step-illustration img {
    display: block;
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* Adjust illustrations on mobile */
@media (max-width: 480px) {
    .step-illustration {
        height: 180px;
    }
}

</style>

<div class="lifestyle-page">
    <div class="lifestyle-container">

        <h1 class="lifestyle-heading">
            Today's Lifestyle
        </h1>

        <p class="lifestyle-description">
            Track your daily habits, one step at a time.
        </p>

        @if(session('success'))
            <div class="record-card" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="record-card error-message" role="alert">
                <strong>Please check your entries:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('lifestyle.store') }}"
              id="lifestyleForm">

            @csrf

            <!-- Record Date -->
            <div style="margin-bottom: 25px;">
                <label for="record_date">
                    Record Date
                </label>

                <input type="date"
                       id="record_date"
                       name="record_date"
                       value="{{ old('record_date', date('Y-m-d')) }}"
                       max="{{ date('Y-m-d') }}"
                       required
                       style="display:block; padding:12px;
                              border-radius:10px; width:100%;
                              margin-top:8px;">
            </div>

            <!-- Progress -->
            <div class="step-progress">
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <p id="stepCounter"
               style="color:#52745c; margin-bottom:15px;">
                Step 1 of 4
            </p>

            <!-- STEP 1: SLEEP -->
            <section class="lifestyle-step active">
               <div class="step-illustration">
    <img src="{{ asset('images/sleep.jpg') }}"
         alt="Sleeping illustration">
</div>

                <h2 class="lifestyle-heading">
                    Your Sleep Duration
                </h2>

                <p class="lifestyle-description">
                    How long did you sleep?
                </p>

                <div class="input-panel">
                    <div class="time-inputs">

                        <div class="time-field">
                            <label for="sleep_hours_input">
                                HOURS
                            </label>
                            <input type="number"
                                   id="sleep_hours_input"
                                   min="0" max="24"
                                   value="0">
                        </div>

                        <div class="time-field">
                            <label for="sleep_minutes_input">
                                MINUTES
                            </label>
                            <input type="number"
                                   id="sleep_minutes_input"
                                   min="0" max="59"
                                   value="0">
                        </div>

                    </div>
                </div>

                <button type="button"
                        class="step-button"
                        onclick="nextStep()">
                    NEXT
                </button>
            </section>

            <!-- STEP 2: SCREEN TIME -->
            <section class="lifestyle-step">
               <div class="step-illustration">
    <img src="{{ asset('images/screentime.png') }}"
         alt="Screentime illustration">
</div>

                <h2 class="lifestyle-heading">
                    Screen Time
                </h2>

                <p class="lifestyle-description">
                    How long did you spend using digital devices?
                </p>

                <div class="input-panel">
                    <div class="time-inputs">

                        <div class="time-field">
                            <label for="screen_hours_input">
                                HOURS
                            </label>
                            <input type="number"
                                   id="screen_hours_input"
                                   min="0" max="24"
                                   value="0">
                        </div>

                        <div class="time-field">
                            <label for="screen_minutes_input">
                                MINUTES
                            </label>
                            <input type="number"
                                   id="screen_minutes_input"
                                   min="0" max="59"
                                   value="0">
                        </div>

                    </div>
                </div>

                <div class="step-buttons">
                    <button type="button"
                            class="step-button back-button"
                            onclick="previousStep()">
                        BACK
                    </button>

                    <button type="button"
                            class="step-button"
                            onclick="nextStep()">
                        NEXT
                    </button>
                </div>
            </section>

            <!-- STEP 3: STUDY -->
            <section class="lifestyle-step">
               <div class="step-illustration">
    <img src="{{ asset('images/study.png') }}"
         alt="Studying illustration">
</div>
                <h2 class="lifestyle-heading">
                    Your Productive Hours
                </h2>

                <p class="lifestyle-description">
                    How much time did you spend studying?
                </p>

                <div class="input-panel">
                    <div class="time-inputs">

                        <div class="time-field">
                            <label for="study_hours_input">
                                HOURS
                            </label>
                            <input type="number"
                                   id="study_hours_input"
                                   min="0" max="24"
                                   value="0">
                        </div>

                        <div class="time-field">
                            <label for="study_minutes_input">
                                MINUTES
                            </label>
                            <input type="number"
                                   id="study_minutes_input"
                                   min="0" max="59"
                                   value="0">
                        </div>

                    </div>
                </div>

                <div class="step-buttons">
                    <button type="button"
                            class="step-button back-button"
                            onclick="previousStep()">
                        BACK
                    </button>

                    <button type="button"
                            class="step-button"
                            onclick="nextStep()">
                        NEXT
                    </button>
                </div>
            </section>

            <!-- STEP 4: EXERCISE -->
            <section class="lifestyle-step">
               <div class="step-illustration">
    <img src="{{ asset('images/exercise.png') }}"
         alt="Running illustration">
</div>

                <h2 class="lifestyle-heading">
                    Today's Physical Activity
                </h2>

                <p class="lifestyle-description">
                    How much time did you spend exercising?
                </p>

                <div class="input-panel">
                    <div class="time-inputs">

                        <div class="time-field">
                            <label for="exercise_hours_input">
                                HOURS
                            </label>
                            <input type="number"
                                   id="exercise_hours_input"
                                   min="0" max="24"
                                   value="0">
                        </div>

                        <div class="time-field">
                            <label for="exercise_minutes_input">
                                MINUTES
                            </label>
                            <input type="number"
                                   id="exercise_minutes_input"
                                   min="0" max="59"
                                   value="0">
                        </div>

                    </div>
                </div>

                <div class="step-buttons">
                    <button type="button"
                            class="step-button back-button"
                            onclick="previousStep()">
                        BACK
                    </button>

                    <button type="submit"
                            class="step-button">
                        SAVE LIFESTYLE
                    </button>
                </div>
            </section>

            <!-- Values submitted to Laravel -->
            <input type="hidden"
                   name="sleep_hours"
                   id="sleep_hours">

            <input type="hidden"
                   name="screen_time_hours"
                   id="screen_time_hours">

            <input type="hidden"
                   name="study_hours"
                   id="study_hours">

            <input type="hidden"
                   name="exercise_minutes"
                   id="exercise_minutes">

        </form>

        <!-- Previous Records -->
        <div style="margin-top:50px;">

            <h2 class="lifestyle-heading">
                Previous Lifestyle Records
            </h2>

            @forelse($records as $record)
                <div class="record-card">

                    <strong>
                        {{ $record->record_date }}
                    </strong>

                    <p> Sleep:
                        {{ $record->sleep_hours ?? '-' }} hours
                    </p>

                    <p> Screen Time:
                        {{ $record->screen_time_hours ?? '-' }} hours
                    </p>

                    <p> Study:
                        {{ $record->study_hours ?? '-' }} hours
                    </p>

                    <p> Exercise:
                        {{ $record->exercise_minutes ?? '-' }} minutes
                    </p>

                </div>
            @empty
                <p>No lifestyle records yet.</p>
            @endforelse

        </div>

    </div>
</div>

<script>
    let currentStep = 0;

    const steps = document.querySelectorAll('.lifestyle-step');
    const progress = document.querySelectorAll('.step-progress span');
    const stepCounter = document.getElementById('stepCounter');

    function showStep() {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === currentStep);
        });

        progress.forEach((bar, index) => {
            bar.classList.toggle('active', index <= currentStep);
        });

        stepCounter.textContent =
            `Step ${currentStep + 1} of ${steps.length}`;
    }

    function nextStep() {
        if (!validateStep(currentStep)) {
            return;
        }

        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep();
        }
    }

    function previousStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep();
        }
    }

    function validateStep(stepIndex) {
        const inputs = steps[stepIndex]
            .querySelectorAll('input[type="number"]');

        for (const input of inputs) {
            if (input.value.trim() === '' ||
                !input.checkValidity()) {
                input.reportValidity();
                return false;
            }
        }

        const hours = Number(inputs[0].value);
        const minutes = Number(inputs[1].value);

        if (hours * 60 + minutes > 1440) {
            alert('Duration cannot exceed 24 hours.');
            return false;
        }

        return true;
    }

    function getDecimalHours(hoursId, minutesId) {
        const hours = Number(
            document.getElementById(hoursId).value
        );

        const minutes = Number(
            document.getElementById(minutesId).value
        );

        return (hours + minutes / 60).toFixed(2);
    }

    const form = document.getElementById('lifestyleForm');

    form.addEventListener('submit', function(event) {
        // Validate every step before saving
        for (let i = 0; i < steps.length; i++) {
            if (!validateStep(i)) {
                event.preventDefault();
                currentStep = i;
                showStep();
                return;
            }
        }

        // Convert hours and minutes into decimal hours
        document.getElementById('sleep_hours').value =
            getDecimalHours(
                'sleep_hours_input',
                'sleep_minutes_input'
            );

        document.getElementById('screen_time_hours').value =
            getDecimalHours(
                'screen_hours_input',
                'screen_minutes_input'
            );

        document.getElementById('study_hours').value =
            getDecimalHours(
                'study_hours_input',
                'study_minutes_input'
            );

        // Exercise is stored as total minutes
        const exerciseHours = Number(
            document.getElementById('exercise_hours_input').value
        );

        const exerciseMinutes = Number(
            document.getElementById('exercise_minutes_input').value
        );

        document.getElementById('exercise_minutes').value =
            exerciseHours * 60 + exerciseMinutes;
    });
</script>

</x-app-layout>
