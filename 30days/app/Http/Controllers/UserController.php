<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Challenge;

class UserController extends Controller
{
    public function show()
    {

        $user = Auth::user();
        $name = $user->name;
        $introduction = $user->introduction;

        $challenge = Challenge::where('user_id', Auth::id())->where('is_completed', 0)->get();

        $is_challenging = !empty($challenge);


        return view('show', compact('name', 'introduction', 'challenge',  'is_challenging'));
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
