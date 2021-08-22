@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-4">

            <div class="card" style="margin: 0 auto;" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="200"
                    xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
                    aria-label="Placeholder: Image cap">
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
            <div class="mt-3 text-right">
                <a class="btn btn-primary" href="/user/edit">編集</a>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-7">
            <form action="">
                <label for="challenge" class="h3 text-secondary">Challenge</label>
                <input id="challenge" class="form-control mb-4" type="text" placeholder="挑戦を記入してください">
                <label for="startday" class="h3 text-secondary">Start Day</label>
                <input type="date" class="form-control mb-4">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
