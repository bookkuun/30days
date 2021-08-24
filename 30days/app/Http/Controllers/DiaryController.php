<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryRequest;
use Illuminate\Http\Request;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{

    public function store(DiaryRequest $request)
    {

        $diary = new Diary();

        $diary->comment = $request->diary;
        $diary->challenge_id =  $request->challenge_id;
        $diary->comment_day =  count(Diary::where('challenge_id', $request->challenge_id)->get()) + 1;
        $diary->save();

        return redirect(route('show', Auth::id()))->with('message', '1日の振り返りを保存しました');
    }

    public function edit(int $diary_id)
    {
        $diary = Diary::where('id', $diary_id)->get();

        $diary_comment = $diary[0]->comment;

        return view('diaries.edit', compact('diary_id', 'diary_comment'));
    }

    public function update(DiaryRequest $request)
    {
        $inputs = $request->all();

        Diary::where('id', $request->diary_id)->update(['comment' => $inputs['diary_comment']]);

        return redirect(route('show', Auth::id()))->with('message', 'Diaryを編集しました');
    }
}
