<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Challenge;
use App\Models\Diary;

class UserController extends Controller
{
    public function show()
    {

        // ユーザー情報
        $user = Auth::user();
        $name = $user->name;
        $introduction = $user->introduction;


        // Challenge情報
        $challenge = Challenge::where('user_id', Auth::id())->where('is_completed', 0)->get();
        $is_challenging = count($challenge);


        if (count($challenge) > 0) {
            $challenge_id = $challenge[0]->id;
            $challenge_title = $challenge[0]->title;

            $diaries = Diary::where('challenge_id', $challenge[0]->id)->get();

            return view('show', compact('name', 'introduction', 'challenge_id', 'challenge_title',  'is_challenging', 'diaries'));
        }

        return view('show', compact('name', 'introduction',  'is_challenging'));
    }

    public function edit()
    {

        $user = Auth::user();
        $name = $user->name;
        $introduction = $user->introduction;

        return view('profile_edit', compact('name', 'introduction'));
    }

    public function update(UserRequest $request)
    {
        $inputs = $request->all();
        User::where('id', Auth::id())->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction']]);

        return redirect(route('show', Auth::id()))->with('message', 'ユーザーを編集しました');
    }
}
