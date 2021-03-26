
    @if($errors->any())
        @foreach($errors->all() as $value)
            <div class="alert alert-danger" role="alert">
                {{ $value }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
