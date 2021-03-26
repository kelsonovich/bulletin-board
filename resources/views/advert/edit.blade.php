@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('advert.update', $advert->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h1 class="mb-3">Edit advert</h1>
                <hr class="mb-2">

                <div class="row">
                    <div class="col mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{ $advert->title }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" count="3" id="description" name="description" placeholder="" required>{{ $advert->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{ $advert->city }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="contact">Contact information</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="" value="{{ $advert->contact }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3"><label for="image">Select photos</label>
                        <div class="custom-file mb-3">
                            <input class="custom-file-input" id="image" type="file" name="image[]" accept="image/*" multiple="multiple" onchange="checkFiles(this.files)">
                            <label class="custom-file-label" >Select a maximum of 5 images...</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
            </div>
        </div>
    </form>
@endsection
