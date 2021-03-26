
    @if(Auth::id() === $advert->user_id && $advert->status === 'active')
        <hr class="mb-2">
        <a href="{{ route('advert.edit', $advert->id) }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Edit</a>
        <a href="{{ route('advert.close', $advert->id) }}" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">Close</a>
    @endif
