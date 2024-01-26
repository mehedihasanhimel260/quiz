<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserResponseController extends Controller
{
    public function store(Request $request)
    {
        $UserResponse = new UserResponse();
        $UserResponse->user_id = Auth::user()->id;
        $UserResponse->quiz_id = $request->quiz_id;
        $UserResponse->question_id = $request->question_id;
        $UserResponse->selected_option_id = $request->selected_option_id;
        $UserResponse->save();
        $nextPageUrl = $request->next_page_url;
        return redirect()->to($nextPageUrl);
    }
}
