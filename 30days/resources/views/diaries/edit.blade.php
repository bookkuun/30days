@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('diary_update', $diary_id) }}">
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
                                    rows="5">{{ $diary_comment }}</textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
