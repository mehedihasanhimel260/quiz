@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Exam Name {{ $quiz->title }}</h6>
                    @if ($UserResponse->isNotEmpty())
                        <h2>You are finish this exam</h2>
                        @foreach ($questions as $question)
                            <h3>{{ $question->text_ques }}</h3>
                            @php
                                $correctAnswer = \App\Models\Option::where('question_id', $question->id)
                                    ->where('is_correct', 1)
                                    ->latest()
                                    ->first();
                            @endphp
                            <p>Correct Answer: {{ $correctAnswer->text }}</p>
                            @php
                                $yourAnswer = \App\Models\UserResponse::where('user_id', Auth::user()->id)
                                    ->where('quiz_id', $quiz->id)
                                    ->where('question_id', $question->id)
                                    ->first();
                            @endphp
                            @if ($yourAnswer)
                                @php
                                    $selectedOption = \App\Models\Option::where('question_id', $question->id)
                                        ->where('id', $yourAnswer->selected_option_id)
                                        ->first();
                                @endphp
                                <p>Your Answer:
                                    {{ $selectedOption ? $selectedOption->text : 'You didn\'t answer this question.' }}</p>
                            @else
                                <p>You didn't answer this question.</p>
                            @endif
                        @endforeach
                    @else
                        <p> Count-down timer (10 minutes) will start at the Start Exam bottom.</p>
                        <a href="{{ route('start.exam', $quiz->id) }}" class="btn btn-outline-success">Start Exam</a>
                    @endif

                </div>
            </div>

        </div>
        <!-- Form End -->
    @endsection
