@section('content')
    <div class="row row-cols-1 row-cols-md-4">
        @foreach($adverts as $key => $advert)
            @if (($key) % 4 === 0 && $key !== 0)
    </div>
    <div class="row row-cols-1 row-cols-md-4">
        @endif
        <div class="col mb-3 h-30">
            <div class="card border-0">
                <img src="{{ '/storage/ad/' . $advert->image  }}" class="card-img-top" style="width:100%; height: 200px;">
                <div class="card-body ml-n3">
                    <a href="{{ route('advert.show', $advert->id) }}" class="card-link stretched-link">{{ $advert->title }}</a>
                    <p class="card-text">{{ $advert->city }}</p>
                    <p class="card-text text-muted"><small>{{ date(('G:i j.m.Y'), strtotime($advert->created_at)) }}</small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row col justify-content-center">
        {!! $adverts->links() !!}
    </div>
@endsection
