<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use App\Models\Challenge;

class DiaryController extends Controller
{

    public function store(DiaryRequest $request)
    {

        $is_todayDiary = Diary::where('challenge_id', $request->challenge_id)
            ->whereBetween('created_at', [date("Y/m/d H:i:s", strtotime('today')), date("Y/m/d H:i:s", strtotime('tomorrow'))])
            ->first();

        if ($is_todayDiary) {
            return redirect(route('user_show', Auth::id()))->with('danger', '今日の振り返りは終えています');
        }

        $diaries = Diary::where('challenge_id', $request->challenge_id)->get();

        $diary = new Diary();
        $diary->comment = $request->diary_comment;
        $diary->challenge_id =  $request->challenge_id;
        $diary->comment_day =  count($diaries) + 1;

        $diary->save();

        // 投稿の数を数える
        $diary_count = count($diaries);

        if ($diary_count === 30) {
            $challenge = Challenge::where('is_completed', 0)->first();
            $challenge->update(['is_completed' => 1, 'is_successful' => 1]);
        }

        return redirect(route('user_show', Auth::id()))->with('message', '1日の振り返りを保存しました');
    }

    public function edit(int $diary_id)
    {
        $diary = Diary::find($diary_id);
        return view('diaries.edit', compact('diary'));
    }

    public function update(DiaryRequest $request)
    {
        $inputs = $request->only(['diary_comment']);
        $diary = Diary::find($request->diary_id);
        $diary->update(['comment' => $inputs['diary_comment']]);

        return redirect(route('user_show', Auth::id()))->with('message', $diary->comment_day . '日目の振り返りを編集しました');
    }
}
