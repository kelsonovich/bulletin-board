@extends('layouts.app')

@section('content')
    @include('messages.success')
    <div class = "row">
        <div class="col">
            <h3>{{ $advert->title }}</h3>
        </div>
    </div>
    <hr class="mb-2">
    <div class="row">
        <div class="col-md-3 order-md-1 mb-4">
            <div class="mb-3">
                <h3><a href="{{ route('user.show', $advert->user_id)  }}" class="">{{ $user->name }} {{ $user->surname }}</a></h3>
                <h4><div class="stars review" style="--rating: {{ $user->rating['index'] }}; "></div> {{ $user->rating['count'] }}</h4>
                <h5><a href="{{ route('review.all', $user->id) }}">{{ $user->rating['count'] }} reviews</a></h5>
                <p>With us with {{ date('d.m.Y', strtotime($user->created_at)) }}</p>
                @include('buttons')
            </div>
        </div>
                <div class="col-md-9 order-md-2">
                    <div id="carousel" class="carousel slide" data-ride="carousel" >
                        <ol class="carousel-indicators">
                            @foreach($advert->image as $key => $item)
                                <li data-target="#carousel" data-slide-to="{{ $key }}" class="{{ $advert->imageClass[$key] }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner" role="listbox" style="width:100%; height: 500px;">
                            @foreach($advert->image as $key => $item)
                                <div class="carousel-item {{ $advert->imageClass[$key] }}">
                                    <img src="{{ asset('storage/ad/' . $item)  }}" class="d-block w-100">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
    </div>
    <hr class="mb-2">
    <div>
        <div class="row">
            <div class="col-sm-2">
                <p>City</p>
            </div>
            <div class="col-sm-10">
                <p>{{ $advert->city }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <p>Contacts</p>
            </div>
            <div class="col-sm-10">
                <p>{{ $advert->contact }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <p>Description</p>
            </div>
            <div class="col-sm-10">
                <p>{{ $advert->description }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <p>Date of placement</p>
            </div>
            <div class="col-sm-10">
                <p>{{ date('d.m.Y', strtotime($advert->created_at)) }} in {{ date('h:i', strtotime($advert->created_at)) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <p>Views</p>
            </div>
            <div class="col-sm-10">
                <p>{{ $advert->views }}</p>
            </div>
        </div>
    </div>


@endsection

