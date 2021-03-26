
    @auth
        <link rel="stylesheet" href="{{ asset("css/review-rating.css") }}">
        <form action="{{ route('review.store', ['to' => $user->id, 'from' => Auth::id()]) }}" method="POST">
            @csrf
            <div class="card border-primary">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="message" class="col-sm-2 col-form-label">Message</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="message" id="message" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                        <div class="col-sm-2">
                            <div class="rating d-flex justify-content-center flex-row-reverse" >
                                <input type="radio" name="rating" id="rating-5" value="5" required/><label for="rating-5"></label>
                                <input type="radio" name="rating" id="rating-4" value="4" required/><label for="rating-4"></label>
                                <input type="radio" name="rating" id="rating-3" value="3" required/><label for="rating-3"></label>
                                <input type="radio" name="rating" id="rating-2" value="2" required/><label for="rating-2"></label>
                                <input type="radio" name="rating" id="rating-1" value="1" required/><label for="rating-1"></label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary btn-block">Add a review</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endauth
