<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function update(Request $request)
    {
        $user = $request->all();

        User::where('id', Auth::id())->update(['name' => $user['name'], 'introduction' => $user['introduction']]);

        return redirect(route('show', Auth::id()));
    }
}
