@extends('layouts.app')
@section('content')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 d-flex justify-content-center mt-5" style="margin-bottom: 400px">
            <div class="col-md-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Exam Name {{ $quiz->title }}</h6>
                    @if ($UserResponse->isNotEmpty())
                        <p>You are finish this exam</p>
                    @else
                        <p> Count-down timer (10 minutes) will start at the Start Exam bottom.</p>
                        <a href="{{ route('start.exam', $quiz->id) }}" class="btn btn-outline-success">Start Exam</a>
                    @endif

                </div>
            </div>

        </div>
        <!-- Form End -->
    @endsection
