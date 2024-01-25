@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Quizz </h6>
                    <form action="{{ route('option.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="id" value="{{ $option->id }}">
                            <input type="hidden" name="question_id" value="{{ $option->question_id }}">
                            <label for="exampleInputEmail1" class="form-label"> Quizz Name</label>
                            <input type="text" class="form-control" value="{{ $option->text }}" name="text"
                                id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Select correct answer</label>
                            <select class="form-select form-select-sm mb-3" name="is_correct"
                                aria-label=".form-select-sm example">
                                <option {{ $option->is_correct == 0 ? 'selected' : '' }} value="0">Wrong Answer
                                </option>
                                <option {{ $option->is_correct == 1 ? 'selected' : '' }} value="1">correct Answer
                                </option>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- Form End -->
    @endsection
