@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Quizz </h6>
                    <form action="{{ route('quiz.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="id" value="{{ $quiz->id }}">
                            <label for="exampleInputEmail1" class="form-label"> Quizz Name</label>
                            <input type="text" class="form-control" value="{{ $quiz->title }}" name="title"
                                id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- Form End -->
    @endsection
