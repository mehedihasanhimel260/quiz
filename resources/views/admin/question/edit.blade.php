@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Carete Quizz Qustion</h6>
                    <form action="{{ route('question.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value=" {{ $questions->id }}">
                        <input type="hidden" name="id" value=" {{ $questions->id }}">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Select Quizz Name</label>
                            <select class="form-select form-select-sm mb-3" name="quiz_id"
                                aria-label=".form-select-sm example">
                                <option selected="">Open this select Quiz</option>
                                @foreach ($quizs as $quiz)
                                    <option value="{{ $quiz->id }}"
                                        {{ $quiz->id == $questions->quiz_id ? 'selected' : '' }}>{{ $quiz->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">

                            <label for="exampleInputEmail1" class="form-label"> Quizz Qustion</label>
                            <input type="text" name="text_ques" value=" {{ $questions->text_ques }}" class="form-control"
                                name="title" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- Form End -->
    @endsection
