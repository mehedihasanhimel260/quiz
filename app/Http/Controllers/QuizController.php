<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizs = quiz::latest()->get();
        return view('admin.quizz.index', compact('quizs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $id = $request->id;
        if (!empty($id)) {
            $quiz = quiz::find($id);
        } else {
            $quiz = new quiz();
        }
        $quiz->title = $request->title;
        $quiz->save();

        return redirect()
            ->route('quiz.index')
            ->with('success', 'Quiz Save successfully.');
    }

    public function edit($id)
    {
        $quiz = quiz::find($id);
        return view('admin.quizz.edit', compact('quiz'));
    }

    public function destroy($id)
    {
        quiz::find($id)->delete();
        return redirect()
            ->route('quiz.index')
            ->with('error', 'Quiz Deleted successfully.');
    }
}
