@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5">
            <div class="col-md-12">
                <div class="bg-secondary rounded  p-4">
                    <h6 class="mb-4">Carete Quizz Qustion</h6>
                    <form action="{{ route('question.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Select Quizz Name</label>
                            <select class="form-select form-select-sm mb-3" name="quiz_id"
                                aria-label=".form-select-sm example">
                                <option selected="">Open this select Quiz</option>
                                @foreach ($quizs as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Quizz Qustion</label>
                            <input type="text" name="text_ques" class="form-control" name="title"
                                id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                </div>

                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">Qustion Option</h6>
                    <form action="{{ route('option.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Qustion</label>
                            <h3>{{ $latestquestions->text_ques }}</h3>
                            <input type="hidden" name="question_id" value="{{ $latestquestions->id }}">
                            @foreach ($options as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" {{ $option->is_correct == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{ $option->text }} <a href="{{ route('option.edit', $option->id) }}">Edit</a> / <a
                                            href="{{ route('option.destroy', $option->id) }}">Delete</a>
                                    </label>
                                </div>
                               
                            @endforeach

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Qustion Option</label>
                            <input type="text" name="text" class="form-control" name="text" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Select correct answer</label>

                            <select class="form-select form-select-sm mb-3" name="is_correct"
                                aria-label=".form-select-sm example">
                                <option selected value="0">Wrong Answer</option>

                                <option value="1">correct Answer</option>

                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                </div>
            </div>
            @foreach ($quizss as $quiz)
                <div class="col-md-12 ">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">{{ $quiz->title }}</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Quiz Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $filtering = $questions->filter(function ($question) use ($quiz) {
                                        return $question->quiz_id == $quiz->id;
                                    });

                                @endphp
                                @foreach ($filtering as $question)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $question->text_ques }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('question.edit', $question->id) }}"
                                                    class="btn btn-outline-primary">Edit </a>
                                                <a href="{{ route('question.destroy', $question->id) }}"
                                                    class="btn btn-outline-primary">Delete </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            {{ $quizss->links() }}

        </div>
        <!-- Form End -->
    @endsection
