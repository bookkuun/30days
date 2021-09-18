<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Mockery\Matcher\Not;
use App\Exceptions\NotFoundException;


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
        $user = User::find($id);
        if (is_null($user)) {
            throw new NotFoundException();
        }

        $challenges = $user->challenges;
        // 現在の挑戦
        $current_challenge = $user->currentChallenge($challenges);
        // チャレンジ数
        $challenge_count = $user->countChallenges($challenges);
        // 成功数
        $success_count = $user->countSuccess($challenges);

        if (isset($current_challenge)) {
            $diaries = $current_challenge->diaries;
            return view('show', compact('user', 'current_challenge', 'challenge_count', 'success_count', 'diaries',));
        }

        return view('show', compact('user', 'current_challenge', 'challenge_count', 'success_count'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = Auth::user();
        $inputs = $request->only(['name', 'introduction']);
        $profile_image = $request->file('profile_image');

        if ($profile_image) {
            $path = \Storage::put('/public', $profile_image);
            $path = explode('/', $path);
            $user->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction'], 'profile_image' => $path[1]]);
        } else {
            $user->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction']]);
        }

        return redirect(route('users.show', Auth::id()))->with('message', 'ユーザーを編集しました');
    }
}
