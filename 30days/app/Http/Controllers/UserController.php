<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Challenge;
use App\Models\Diary;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('index', compact('users'));
    }

    public function show($id)
    {
        // user
        $user = User::findOrFail($id);

        // challenge
        $challenge = Challenge::whereUserId($id)->whereIsCompleted(0)->first();
        $is_challenging = !empty($challenge);

        if ($is_challenging) {
            // diary
            $diaries = Diary::whereChallengeId($challenge->id)->get();
            return view('show', compact('user', 'challenge', 'diaries', 'is_challenging'));
        }

        return view('show', compact('user', 'is_challenging'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $inputs = $request->only(['name', 'introduction']);
        $profile_image = $request->file('profile_image');

        if ($profile_image) {
            $path = \Storage::put('/public', $profile_image);
            $path = explode('/', $path);
            $user->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction'], 'profile_image' => $path[1]]);
        } else {
            $user->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction']]);
        }

        return redirect(route('user_show', $user->id))->with('message', 'ユーザーを編集しました');
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::id() == $id) {
            Auth::user()->delete();
            return redirect()->route('register')->with('message', '退会処理が完了しました');
        }
        return redirect()->route('user_show', $id)->with('message', '退会処理が失敗しました');
    }
}
