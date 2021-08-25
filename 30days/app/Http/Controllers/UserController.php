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

        $name = $user->name;
        $introduction = $user->introduction;
        $profile_image = $user->profile_image;


        // Challenge情報
        $challenge = Challenge::where('user_id', $id)->where('is_completed', 0)->get();
        $is_challenging = count($challenge);


        if (count($challenge) > 0) {
            $challenge_id = $challenge[0]->id;
            $challenge_title = $challenge[0]->title;
            $diaries = Diary::where('challenge_id', $challenge[0]->id)->get();

            return view('show', compact('id', 'name', 'introduction', 'challenge_id', 'challenge_title',  'is_challenging', 'diaries', 'profile_image'));
        }

        return view('show', compact('id', 'name', 'introduction',  'is_challenging'));
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

        $profile_image = $request->file('profile_image');

        if ($request->hasFile('profile_image')) {
            $path = \Storage::put('/public', $profile_image);
            $path = explode('/', $path);
        } else {
            $path = null;
        }


        User::where('id', Auth::id())->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction'], 'profile_image' => $path[1]]);
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
