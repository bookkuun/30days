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

        // challenge
        $challenges = $user->challenges;
        $is_challenging = $challenges->where('is_completed', 0)->first();

        // チャレンジ数
        $challenge_count = $user->challengeCount($challenges);
        // 成功数
        $success_count = $user->successCount($challenges);

        if ($is_challenging) {
            // diary
            $diaries = $is_challenging->diaries;
            return view('show', compact('user', 'diaries', 'is_challenging', 'challenge_count', 'success_count'));
        }

        return view('show', compact('user', 'is_challenging', 'challenge_count', 'success_count'));
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
            $result = $user->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction'], 'profile_image' => $path[1]]);
        } else {
            $result = $user->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction']]);
        }

        if (!$result) {
            abort(500);
        }

        return redirect(route('user_show', Auth::id()))->with('message', 'ユーザーを編集しました');
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::id() == $id) {
            Auth::user()->delete();
            return redirect()->route('register')->with('message', '退会処理が完了しました');
        }
        return redirect()->route('user_show', Auth::id())->with('message', '退会処理が失敗しました');
    }
}
