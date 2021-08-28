<div class="row">
    <div class="col-4">
        @include('dashbord.profile_card')
    </div>
    <div class="col-1"></div>
    <div class="col-7">
        @if($is_challenging)
        <div class="h3 text-secondary mb-3">Challenge</div>
        <div class="h3 card p-3 mb-5">
            {{ $is_challenging->title }}
        </div>
        <div class="h3 text-secondary">毎日の振り返り</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-2" scope="col">日数</th>
                    <th class="col-8" scope="col">振り返り</th>
                </tr>
            </thead>
            <tbody>
                {{-- 繰り返し処理 --}}
                @foreach ($diaries as $diary)
                <tr>
                    <th scope="row">{{ $diary->comment_day }} </th>
                    <td>{{ $diary->comment }}</td>
                </tr>
                @endforeach
                {{-- 繰り返し処理終わり --}}
            </tbody>
        </table>
        @else
        なにもチャレンジしていません
        @endif
    </div>
</div>
