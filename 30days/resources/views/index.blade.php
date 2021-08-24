@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($users as $user)
        <div class="col-3 ">
            <div class="card mb-5" style="margin: 0 auto;" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="200"
                    xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
                    aria-label="Placeholder: Image cap">
                    <rect width="100%" height="100%" fill="#868e96" />
                </svg>
                <div class="card-body">
                    <h3 class="card-title"><a href="{{ route('show',$user->id) }}">{{ $user->name }}</a></h3>
                    <h5 class="card-title">自己紹介</h5>
                    <p class="card-text">{{ $user->introduction }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
