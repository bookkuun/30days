@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('challenge_update', $challenge_id) }}">
                        @csrf
                        <div class="h1 mb-4">
                            Challegeの編集
                        </div>
                        {{-- エラーメッセージ --}}
                        @include('common.errors')
                        <input type="hidden" name="challnege_id" value="{{ $challenge_id }}">
                        <input type="hidden" name="start_day" value="{{ $start_day }}">
                        <div class="form-group">
                            <div class="mb-4">
                                <label for="challenge_title" class="h3">Challenge</label>
                                <input id="challenge_title" type="text" class="form-control" name="challenge_title"
                                    value="{{ $challenge_title }}">
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
