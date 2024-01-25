@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Carete Quizz</h6>
                    <form action="{{ route('quiz.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Quizz Name</label>
                            <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                aria-describedby="emailHelp">

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">All Quizz list</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Quiz Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizs as $quiz)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $quiz->title }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('quiz.edit', $quiz->id) }}"
                                                class="btn btn-outline-primary">Edit </a>
                                            <a href="{{ route('quiz.destroy', $quiz->id) }}"
                                                class="btn btn-outline-primary">Delete </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Form End -->
    @endsection
