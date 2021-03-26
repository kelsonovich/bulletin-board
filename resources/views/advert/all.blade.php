@extends('layouts.app')

@section('content')
    <div class = "row">
        <div class="col">
            <h3><a href="{{ route('user.show', $user->id) }}" class="text-dark">{{ $user->name }} {{ $user->surname }}</a></h3>
        </div>
    </div>
    <hr class="mb-2">
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link disabled" id="v-pills-profile-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-profile" aria-selected="false" >
                    Total {{ $adverts['count']['active'] + $adverts['count']['closed']}}
                </a>
                <a class="nav-link active" id="v-active" data-toggle="pill" href="#active" role="tab" aria-controls="active" aria-selected="true">
                    Active {{ $adverts['count']['active'] }}
                </a>
                <a class="nav-link" id="v-closed" data-toggle="pill" href="#closed" role="tab" aria-controls="closed" aria-selected="false">
                    Closed {{ $adverts['count']['closed'] }}
                </a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                @foreach($adverts['all'] as $key => $advert)
                    <div class="tab-pane show {{ $key }}" id="{{ $key }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach($advert as $num => $item)
                                @if (($num) % 3 === 0 && $num !== 0)
                        </div>
                        <div class="row row-cols-1 row-cols-md-3">
                            @endif
                            <div class="col mb-4">
                                <div class="card border-0">
                                    <img src="{{ '/storage/ad/' . $item->image  }}" class="card-img-top" style="width:100%; height: 200px;">
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
    </div>
@endsection
