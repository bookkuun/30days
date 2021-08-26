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
        $challenge = Challenge::whereId($challenge_id)->first();

        return view('challenges.edit', compact('challenge'));
    }

    public function update(ChallengeRequest $request)
    {
        $inputs = $request->only(['challenge_title']);
        Challenge::whereId($request->challenge_id)->update(['title' => $inputs['challenge_title']]);

        return redirect(route('show', Auth::id()))->with('message', 'Challengeを編集しました');
    }

    public function destroy($challenge_id)
    {
        Challenge::whereId($challenge_id)->whereUserId(Auth::id())->delete();

        return redirect(route('show', Auth::id()))->with('message', 'Challengeをやめました');
    }
}
