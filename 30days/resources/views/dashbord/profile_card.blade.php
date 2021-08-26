<div class="card" style="margin: 0 auto;" style="width: 18rem;">

    @if(!empty($user->profile_image))
    <img height="250" src="{{ '/storage/' . $user->profile_image }}" alt="">
    @else
    <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
        <rect width="100%" height="100%" fill="#868e96" />
    </svg>
    @endif

    <div class="card-body">
        <h3 class="card-title">{{ $user->name }}</h3>
        <h5 class="card-title">自己紹介</h5>
        <p class="card-text">{{ $user->introduction }}</p>
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
