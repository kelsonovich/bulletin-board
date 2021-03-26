
    @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning text-center" role="alert">
            {{ session('warning') }}
        </div>
    @endif


    @if(isset($success))
        <div class="alert alert-success text-center" role="alert">
            {{ $success }}
        </div>
    @elseif(isset($warning))
        <div class="alert alert-warning text-center" role="alert">
            {{ $warning }}
        </div>
    @endif

