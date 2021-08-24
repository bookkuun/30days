<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryRequest;
use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{

    public function store(DiaryRequest $request)
    {

        $diaries = Diary::where('challenge_id', $request->challenge_id);

        // １日１投稿
        $is_todayDiary = count($diaries->whereBetween('created_at', [date("Y/m/d H:i:s", strtotime('today')), date("Y/m/d H:i:s", strtotime('tomorrow'))])->get()) > 0;

        if ($is_todayDiary) {
            return redirect(route('show', Auth::id()))->with('danger', '今日の振り返りは終えています');
        }

        $diary = new Diary();
        $diary->comment = $request->diary_comment;
        $diary->challenge_id =  $request->challenge_id;
        $diary->comment_day =  count($diaries->get()) + 1;
        $diary->save();

        $diary_count = count($diaries->get());





        if ($diary_count === 30) {
            $challenge = Challenge::where('is_completed', 0)->get();
            $challenge[0]->update(['is_completed' => 1, 'is_successful' => 1]);
        }

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
