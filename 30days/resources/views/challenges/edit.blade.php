@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="h1 mb-4">
                            Chalelnge編集
                        </div>
                        <div>
                            <form action="{{ route('challenge_delete', $challenge->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Challengeをやめる
                                </button>
                            </form>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('challenge_update', $challenge->id) }}">
                        @csrf
                        {{-- エラーメッセージ --}}
                        @include('common.errors')
                        <input type="hidden" name="challnege_id" value="{{ $challenge->id }}">
                        <input type="hidden" name="start_day" value="{{ $challenge->start_day }}">
                        <div class="form-group">
                            <div class="mb-4">
                                <label for="challenge_title" class="h3">Challenge</label>
                                <input id="challenge_title" type="text" class="form-control" name="challenge_title"
                                    value="{{ $challenge->title }}">
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
