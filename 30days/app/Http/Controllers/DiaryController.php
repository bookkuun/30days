<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{

    public function store(Request $request)
    {

        $diary = new Diary();

        $diary->comment = $request->diary;
        $diary->challenge_id =  $request->challenge_id;
        $diary->comment_day =  count(Diary::where('challenge_id', $request->challenge_id)->get()) + 1;
        $diary->save();

        return redirect(route('show', Auth::id()))->with('message', '1日の振り返りを保存しました');
    }
}
