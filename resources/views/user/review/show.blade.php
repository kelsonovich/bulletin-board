
    @foreach($reviews as $review)
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 order-md-1">
                        <h4><a href="{{ route('user.show',  $review->user['id']) }}" class="text-dark">
                                {{ $review->user['name'] }}
                            </a></h4>
                        <div>{{ date(('d.m.Y'), strtotime($review->created_at)) }}</div>
                    </div>
                    <div class="col-md-8 order-md-2">
                        <div class="stars review" style="--rating: {{ $review->rating }}; "></div>
                        <div>{{ $review->message }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
