@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('advert.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h1 class="mb-3">Add new advert</h1>
                <hr class="mb-2">

                <div class="row">
                    <div class="col mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value="" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" count="3" id="description" name="description" placeholder="" required></textarea>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="contact">Contact information</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3"><label for="image">Select photos</label>
                        <div class="custom-file mb-3">
                            <input class="custom-file-input" id="image" type="file" name="image[]" accept="image/*" multiple="multiple" onchange="checkFiles(this.files)" required>
                            <label class="custom-file-label" >Select a maximum of 5 images...</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Create</button>
            </div>
        </div>
    </form>

    <script type="text/javascript" src="{{ asset('js/multiselect.js') }}" ></script>
@endsection

