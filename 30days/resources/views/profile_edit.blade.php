@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('profile_update') }}">
                        @csrf
                        <div class="h1 mb-4">
                            ユーザー編集
                        </div>
                        {{-- エラーメッセージ --}}
                        @include('common.errors')
                        <div class="form-group">
                            <div class="mb-4">
                                <label for="name" class="h3">ユーザーネーム</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $name }}">
                            </div>
                            <div class="mb-4">
                                <label for="introduction" class="h3">自己紹介</label>
                                <textarea id="introduction" type="textarea" class="form-control"
                                    name="introduction">{{ $introduction }}</textarea>
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
