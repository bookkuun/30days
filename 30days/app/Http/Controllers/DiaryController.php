<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiaryRequest;
use App\Models\Challenge;
use App\Models\Diary;

class DiaryController extends Controller
{

    public function store(DiaryRequest $request)
    {

        $challenge = Challenge::find($request->challenge_id);

        $is_todayDiary = Diary::where('challenge_id', $request->challenge_id)
            ->whereBetween('created_at', [date("Y/m/d H:i:s", strtotime('today')), date("Y/m/d H:i:s", strtotime('tomorrow'))])
            ->first();

        if ($is_todayDiary) {
            return redirect(route('user_show', Auth::id()))->with('danger', '今日の振り返りは終えています');
        }

        $diaries = $challenge->diaries;

        $diary = new Diary();
        $diary->comment = $request->diary_comment;
        $diary->challenge_id =  $request->challenge_id;
        $diary->comment_day =  count($diaries) + 1;
        $diary->save();

        // 投稿の数を数える
        $diaries = Challenge::find($request->challenge_id)->diaries;
        $diary_count = count($diaries);

        if ($diary_count === 30) {
            $challenge->is_completed = 1;
            $challenge->is_successful = 1;
            $challenge->save();
        }

        return redirect(route('user_show', Auth::id()))->with('message', '1日の振り返りを保存しました');
    }

    public function edit(int $diary_id)
    {
        $diary = Diary::find($diary_id);
        if (is_null($diary)) {
            throw new NotFoundException();
        }

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
