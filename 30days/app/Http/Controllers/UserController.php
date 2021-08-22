<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $name = $user->name;
        $introduction = $user->introduction;
        return view('show', compact('name', 'introduction'));
    }

    public function edit()
    {

        $user = Auth::user();
        $name = $user->name;
        $introduction = $user->introduction;

        return view('edit', compact('name', 'introduction'));
    }

    public function update(UserRequest $request)
    {
        $inputs = $request->all();

        User::where('id', Auth::id())->update(['name' => $inputs['name'], 'introduction' => $inputs['introduction']]);

        return redirect(route('show', Auth::id()))->with('message', 'ユーザーを編集できました');
    }
}
