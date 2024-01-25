<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizs = quiz::latest()->get();
        $quizss = quiz::latest()->paginate(1);
        $questions = Question::latest()->get();
        return view('admin.question.index', compact('questions', 'quizs', 'quizss'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required',
            'text_ques' => 'required',
        ]);

        $id = $request->id;
        if (!empty($id)) {
            $question = Question::find($id);
        } else {
            $question = new Question();
        }
        $question->quiz_id = $request->quiz_id;
        $question->text_ques = $request->text_ques;
        $question->save();

        return redirect()
            ->route('question.index')
            ->with('success', 'Question Save successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quizs = quiz::latest()->get();
        $questions = Question::find($id);
        return view('admin.question.edit', compact('questions', 'quizs'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Question::find($id)->delete();
        return redirect()
            ->route('question.index')
            ->with('error', 'Question Deleted successfully.');
    }
}
