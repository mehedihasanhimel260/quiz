@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <form action="{{ route('userResponse.store') }}" method="post">
                    @csrf
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Exam Name {{ $quiz->title }}</h6>
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @php
                            $data = \App\Models\TimeCounDown::where('quiz_id', $quiz->id)
                                ->where('user_id', Auth::user()->id)
                                ->first();
                            $examStartTime = strtotime($data->created_at); // Convert to UNIX timestamp
                        @endphp
                        <h6 class="mb-4">Exam Start time: {{ date('h:i:s A', $examStartTime) }}</h6>
                        <h2> You have: <span id="demo"></span> mins </h2>
                        @foreach ($questions as $question)
                            <h4> {{ $question->text_ques }}</h4>


                            <input type="hidden" name="question_id" value=" {{ $question->id }}">

                            @php
                                $options = \App\Models\Option::where('question_id', $question->id)
                                    ->latest()
                                    ->get();
                            @endphp

                            @foreach ($options as $option)
                                <div class="form-check">

                                    <input class="form-check-input" type="radio" value="{{ $option->id }}"
                                        name="selected_option_id" id="flexRadioDefault{{ $option->id }}">
                                    <label class="form-check-label" for="flexRadioDefault{{ $option->id }}">
                                        {{ $option->text }}
                                    </label>
                                </div>
                            @endforeach
                        @endforeach
                        @if ($questions->nextPageUrl())
                            <input type="hidden" name="next_page_url" value="{{ $questions->nextPageUrl() }}">
                        @else
                            <input type="hidden" name="next_page_url" value="{{ url('user/quiz/exam/' . $quiz->id) }}">
                        @endif

                        <button class="btn btn-outline-success" type="submit">Submit </button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form End -->

    <script>
        var examStartTime = new Date({{ $examStartTime }} * 1000);
        var countDownDate = new Date(examStartTime.getTime() + (10 * 60 * 1000));
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var minutes = Math.floor(distance / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection
