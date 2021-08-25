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
                            <form action="{{ route('user_delete', Auth::id()) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="退会" class="btn btn-danger"
                                    onclick='return confirm("本当に退会しますか？");'>
                            </form>
                        </div>
                    </div>

                    {{-- エラーメッセージ --}}
                    <form method="POST" action="{{ route('profile_update') }}" enctype="multipart/form-data">
                        @csrf
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

                            <div class="mb-4">
                                <label for="profile_image" class="h3">プロフィール画像</label>
                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                保存
                            </button>
                            <a class="btn btn-primary" href="{{ route('show', Auth::id()) }}">
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
