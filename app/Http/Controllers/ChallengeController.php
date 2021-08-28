<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChallengeRequest;
use App\Models\Challenge;
use Faker\Provider\Base;
use App\Exceptions\NotFoundException;


class ChallengeController extends Controller
{
    public function store(ChallengeRequest $request)
    {
        $challenge = new Challenge();
        $challenge->title = $request->challenge_title;
        $challenge->start_day =  $request->start_day;
        $challenge->end_day = date("Y-m-d", strtotime($request->start_day . "+29 day"));
        $challenge->user_id =   $request->user_id;
        $challenge->is_completed =  0;

        $challenge->save();

        return redirect(route('user_show', Auth::id()))->with('message', 'Challengeを設定しました');
    }

    public function edit(int $challenge_id)
    {
        $user = Auth::user();
        $challenge = $user->challenges->find($challenge_id);
        if (is_null($challenge)) {
            throw new NotFoundException();
        }

        return view('challenges.edit', compact('challenge'));
    }

    public function update(ChallengeRequest $request)
    {
        $inputs = $request->only(['challenge_title']);
        Challenge::find($request->challenge_id)->update(['title' => $inputs['challenge_title']]);

        return redirect(route('user_show', Auth::id()))->with('message', 'Challengeを編集しました');
    }

    public function destroy($challenge_id)
    {
        Challenge::whereId($challenge_id)->whereUserId(Auth::id())->delete();

        return redirect(route('user_show', Auth::id()))->with('message', 'Challengeをやめました');
    }
}
