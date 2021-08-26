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
    public function index()
    {
        $users = User::all();
        return view('index', compact('users'));
    }

    public function show($id)
    {
        // ユーザー情報
        $user = User::find($id);

        // Challenge情報
        $challenge = Challenge::whereUserId($id)->whereIsCompleted(0)->first();
        $is_challenging = !empty($challenge);

        if ($is_challenging) {
            $diaries = Diary::whereChallengeId($challenge->id)->get();
            return view('show', compact('user', 'challenge', 'diaries', 'is_challenging'));
        }

        return view('show', compact('user', 'is_challenging'));
    }

    public function edit()
    {

        $user = Auth::user();
        $name = $user->name;
        $introduction = $user->introduction;
        $profile_image = $user->profile_image;

        return view('profile_edit', compact('name', 'introduction', 'profile_image'));
    }

    public function update(UserRequest $request)
    {
        $inputs = $request->all();

        $profile_image = $request->file('profile_image');

        if ($request->hasFile('profile_image')) {
            $path = \Storage::put('/public', $profile_image);
            $path = explode('/', $path);
            User::where('id', Auth::id())->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction'], 'profile_image' => $path[1]]);
        } else {
            User::where('id', Auth::id())->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction']]);
        }

        return redirect(route('show', Auth::id()))->with('message', 'ユーザーを編集しました');
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::id() == $id) {
            Auth::user()->delete();
            return redirect()->route('register')->with('message', '退会処理が完了しました');
        }
    }
}
