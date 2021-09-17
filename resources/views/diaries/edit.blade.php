@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('diaries.update', $diary->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="h1 mb-4">
                            Diaryの編集
                        </div>
                        {{-- エラーメッセージ --}}
                        @include('common.errors')
                        <div class="form-group">
                            <div class="mb-4">
                                <label for="diary_comment" class="h3">Diary</label>
                                <textarea id="diary_comment" type="textarea" class="form-control" name="diary_comment"
                                    rows="5">{{ $diary->comment }}</textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                保存
                            </button>
                            <a class="btn btn-primary" href="{{ route('user_show', Auth::id()) }}">
                                戻る
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
