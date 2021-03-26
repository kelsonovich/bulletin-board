@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset("css/profile-rating.css") }}">
    <div class = "row">
        <div class="col">
            <h3><a href="{{ route('user.show', $user->id) }}" class="text-dark">{{ $user->name }} {{ $user->surname }}</a></h3>
        </div>
    </div>
    <div class = "row">
        <div class="col">
            <h6>Total reviews: {{ count($reviews) }}</h6>
        </div>
    </div>
    <hr class="mb-2">
    @include('user.review.show')
@endsection
