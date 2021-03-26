@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('user.update', Auth::id()) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @if(session('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 order-md-1 mb-4">
                <img src="{{ '/storage/user/' . $user->photo }}" class="card-img-top" width="300" height="300">
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input form-control" id="photo" name="photo" size="2048" accept="image/*">
                    <label class="custom-file-label" for="photo">Select a photo...</label>
                </div>
            </div>
            <div class="col-md-8 order-md-2">
                <h4 class="mb-3">Edit your profile</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="" value="{{ $user->surname }}" >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="" value = "{{ $user->email }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" placeholder="" name="country" value = "{{ $user->country }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="" name="city" value = "{{ $user->city }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" count="3" id="description" name="description" placeholder="" >{{ $user->description }}</textarea>
                </div>

            </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
    </form>
@endsection
