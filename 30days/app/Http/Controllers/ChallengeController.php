<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{

    public function store(Request $request)
    {
        $challenge = new Challenge();

        $challenge->title = $request->challenge_title;
        $challenge->start_day =  $request->start_day;
        $challenge->end_day = date("Y-m-d", strtotime($request->start_day . "+29 day"));
        $challenge->user_id =  Auth::id();

        $challenge->save();
        return redirect(route('show', Auth::id()))->with('message', 'Challengeを設定しました');
    }
}
