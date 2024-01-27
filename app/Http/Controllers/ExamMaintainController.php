<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\quiz;
use App\Models\TimeCounDown;
use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamMaintainController extends Controller
{
    public function quiz_exam($id)
    {
        $quiz = quiz::find($id);
        $UserResponse = UserResponse::where('user_id', Auth::user()->id)
            ->where('quiz_id', $id)
            ->get();
        $questions = Question::where('quiz_id', $id)
            ->latest()
            ->get();
        return view('admin.quizz.view', compact('quiz', 'UserResponse', 'questions'));
    }
    public function startexam($id)
    {
        $data = TimeCounDown::where('quiz_id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();
        if (!empty($data)) {
            $startexam = TimeCounDown::find($data->id);
        } else {
            $startexam = new TimeCounDown();
        }
        $startexam->quiz_id = $id;
        $startexam->user_id = Auth::user()->id;
        $startexam->save();
        $quiz = quiz::find($id);

        $questions = Question::where('quiz_id', $id)
            ->latest()
            ->paginate(1);

        return view('admin.exam.index', compact('quiz', 'questions'))->with('success', 'Exam Start.');
    }
}
