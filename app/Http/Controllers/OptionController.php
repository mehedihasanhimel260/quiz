<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'text' => 'required',
            'is_correct' => 'required',
        ]);

        $id = $request->id;
        if (!empty($id)) {
            $questionOption = Option::find($id);
        } else {
            $questionOption = new Option();
        }
        $questionOption->question_id = $request->question_id;
        $questionOption->text = $request->text;
        $questionOption->is_correct = $request->is_correct;
        $questionOption->save();

        return redirect()
            ->route('question.index')
            ->with('success', 'Question Option Save successfully.');
    }

    public function edit($id)
    {
        $option = Option::find($id);
        return view('admin.option.edit',compact('option'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Option::find($id)->delete();
        return redirect()
            ->route('question.index')
            ->with('error', 'Option Deleted successfully.');
    }
}
