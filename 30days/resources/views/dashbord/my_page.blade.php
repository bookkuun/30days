{{-- フラッシュメッセージ --}}
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="row">
    <div class="col-4">
        @include('dashbord.profile_card')
        <div class="mt-3 text-right">
            <a class="btn btn-primary" href="{{ route('profile_edit') }}">編集</a>
        </div>
    </div>
    <div class="col-1"></div>
    <div class="col-7">
        @if($is_challenging)
        <div class="h3 text-secondary mb-3">Challenge</div>
        <div class="h3 card p-3">
            {{ $challenge->title }}
        </div>
        <div class="mt-3 text-right mb-5">
            <a class="btn btn-primary" href="{{ route('challenge_edit', $challenge->id) }}">編集</a>
        </div>
        @include('common.errors')
        @if(session('danger'))
        <div class="alert alert-danger">
            <ul class="align-items-center mb-0">
                <li>{{session('danger')}}</li>
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('diary_store') }}">
            @csrf
            <div class="form-group">
                <div class="mb-4">
                    <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
                    <label for="diary_comment" class="h3 text-secondary">1日の振り返り</label>
                    <div class="text-secondary mb-3">
                        ※振り返りは1日1回です
                    </div>
                    <textarea id="diary_comment" type="textarea" class="form-control" name="diary_comment"
                        rows="5"></textarea>
                </div>
            </div>
            <div class="text-right mb-5">
                <button type="submit" class="btn btn-primary">
                    保存
                </button>
            </div>
        </form>
        <div class="h3 text-secondary">毎日の振り返り</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-2" scope="col">日数</th>
                    <th class="col-8" scope="col">振り返り</th>
                    <th class="col-2" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                {{-- 繰り返し処理 --}}
                @foreach ($diaries as $diary)
                <tr>
                    <th scope="row">{{ $diary->comment_day }} </th>
                    <td>{{ $diary->comment }}</td>
                    <td><a class="btn btn-primary" href="{{ route('diary_edit', $diary->id) }}">編集</a></td>
                </tr>
                @endforeach
                {{-- 繰り返し処理終わり --}}
            </tbody>
        </table>
        @else
        @include('common.errors')
        <form action="{{ route('challenge_store') }}" method="POST">
            @csrf
            <label for="challenge_title" class="h3 text-secondary">Challenge</label>
            <input type="text" id="challenge_title" name="challenge_title" class="form-control mb-4"
                placeholder="挑戦を記入してください">
            <label for="startday" class="h3 text-secondary">Start Day</label>
            <input type="date" id="start_day" name="start_day" class="form-control mb-4">
            <div class="text-right mb-5">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
        @endif
    </div>
</div>
