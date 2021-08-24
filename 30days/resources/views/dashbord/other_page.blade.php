<div class="row">
    <div class="col-4">
        <div class="card" style="margin: 0 auto;" style="width: 18rem;">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                <rect width="100%" height="100%" fill="#868e96" />
            </svg>
            <div class="card-body">
                <h3 class="card-title">{{ $name }}</h3>
                <h5 class="card-title">自己紹介</h5>
                <p class="card-text">{{ $introduction }}</p>
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th class="col-6" scope="col">チャレンジ数</th>
                            <th class="col-6" scope="col">成功数</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
    <div class="col-7">
        @if($is_challenging)
        <div class="h3 text-secondary mb-3">Challenge</div>
        <div class="h3 card p-3 mb-5">
            {{ $challenge_title }}
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
