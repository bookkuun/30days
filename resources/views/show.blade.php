@extends('layouts.app')

@section('content')
<div class="container mt-5">


    @if ($user->id == Auth::id() )
    @include('dashbord.my_page')
    @else
    @include('dashbord.other_page')
    @endif
</div>
@endsection
