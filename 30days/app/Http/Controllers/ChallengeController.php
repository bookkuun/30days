<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChallengeRequest;
use Illuminate\Http\Request;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{

    public function store(ChallengeRequest $request)
    {
        $challenge = new Challenge();

        $challenge->title = $request->challenge_title;
        $challenge->start_day =  $request->start_day;
        $challenge->end_day = date("Y-m-d", strtotime($request->start_day . "+29 day"));
        $challenge->user_id =  Auth::id();
        $challenge->is_completed =  0;

        $challenge->save();

        return redirect(route('show', Auth::id()))->with('message', 'Challengeを設定しました');
    }

    public function edit(int $challenge_id)
    {
        $challenge = Challenge::where('id', $challenge_id)->get();

        $challenge_title = $challenge[0]->title;
        $start_day = $challenge[0]->start_day;

        return view('challenges.edit', compact('challenge_id', 'challenge_title', 'start_day'));
    }

    public function update(ChallengeRequest $request)
    {
        $inputs = $request->all();
        Challenge::where('id', $request->challenge_id)->update(['title' => $inputs['challenge_title']]);

        return redirect(route('show', Auth::id()))->with('message', 'Challengeを編集しました');
    }
}
