
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl"
            style="color: #52745C;">
            My Dashboard
        </h2>
    </x-slot>

    <div class="py-8"
         style="background-color: #F5F7F0;">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Welcome Message -->
            <div class="bg-white p-6 rounded-xl shadow-sm mb-6">

                <h1 class="text-2xl font-bold"
                    style="color: #52745C;">

                    Hello, {{ Auth::user()->name }}!

                </h1>

                <p class="text-gray-500 mt-2">
                    Welcome to Ikigai Masho!
                    Let's work towards a balanced life.
                </p>

            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2
                        lg:grid-cols-3 gap-5">

                
<a href="{{ route('lifestyle.index') }}"
   class="block bg-white p-6 rounded-xl shadow-sm
          hover:shadow-lg transition duration-300">

    <h3 class="font-bold text-lg"
        style="color: #52745C;">
        Lifestyle Tracking
    </h3>

    <p class="text-gray-500 mt-2">
        Record your daily activities
        and lifestyle habits.
    </p>

    <p class="mt-4 font-semibold"
       style="color: #52745C;">
        Start Tracking →
    </p>

</a>


               
<a href="{{ route('stress.index') }}"
   class="block bg-white p-6 rounded-xl shadow-sm
          hover:shadow-lg transition duration-300">

    <h3 class="font-bold text-lg"
        style="color: #52745C;">
        Stress Assessment
    </h3>

    <p class="text-gray-500 mt-2">
        Complete your PSS-10 questionnaire
        and monitor your perceived stress.
    </p>

    <p class="mt-4 font-semibold"
       style="color: #52745C;">
        Start Assessment →
    </p>

</a>


                
<a href="{{ route('lifestyle.analysis') }}"
   class="block bg-white p-6 rounded-xl shadow-sm
          hover:shadow-lg transition duration-300">

    <h3 class="font-bold text-lg"
        style="color: #52745C;">
        BI Dashboard
    </h3>

    <p class="text-gray-500 mt-2">
        Explore your lifestyle patterns
        and analysis.
    </p>

    <p class="mt-4 font-semibold"
       style="color: #52745C;">
        View Analysis →
    </p>

</a>

            </div>

        </div>

    </div>

</x-app-layout>

