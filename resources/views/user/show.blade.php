@extends('layouts.app')

@section('content')
    @include('messages.success')
    <link rel="stylesheet" href="{{ asset("css/profile-rating.css") }}">
    <div class="row">
        <div class="col-md-8 order-md-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                        Active <span class="badge badge-pill badge-primary">{{ $adverts['count']['active'] }}</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false">
                        Closed <span class="badge badge-pill badge-secondary">{{ $adverts['count']['closed'] }}</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('advert.all', $user->id) }}">
                        Show all...
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                @foreach($adverts['all'] as $key => $advert)
                    <div class="tab-pane fade show {{ $key }}" id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row row-cols-1 row-cols-md-2">
                            @foreach($advert as $num => $item)
                                @if (($num) % 4 === 0 && $num !== 0)
                        </div>
                        <div class="row row-cols-1 row-cols-md-2">
                            @endif
                            <div class="col mb-3">
                                <div class="card border-0">
                                    <img src="{{ asset('/storage/ad/' . $item->image)  }}" class="card-img-top" style="width:100%; height: 200px;">
                                    <div class="card-body ml-n3">
                                        <a href="{{ route('advert.show', $item->id) }}" class="card-link stretched-link">{{ $item->title }}</a>
                                        <p class="card-text">{{ $item->city }}</p>
                                        <p class="card-text text-muted"><small>{{ date(('G:i j.m.Y'), strtotime($item->created_at)) }}</small></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 order-md-1 mb-4">
            <div class="card">
                <img src="{{ '/storage/user/' . $user->photo }}" class="img-thumbnail"  height="300">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $user->name . ' ' . $user->surname }}</li>
                        <li class="list-group-item">{{ $user->email }}</li>
                        <li class="list-group-item">{{ $user->from }}</li>
                        <li class="list-group-item">Registration date: {{ date('d.m.Y', strtotime($user->created_at)) }}</li>
                        <li class="list-group-item">
                            <h3><div class="stars" style="--rating: {{ $user->rating['index'] }};"></div> {{ $user->rating['index'] }}</h3>
                            <h5><a href="{{ route('review.all', $user->id) }}">{{ $user->rating['count'] }} reviews</a></h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4">Latest reviews</h3>
    <hr class="mb-2">
        @include('user.review.create')
        @include('user.review.show')

@endsection
