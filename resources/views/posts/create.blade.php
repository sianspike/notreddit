@extends('layouts.app')

@section('content')

    <!-- Create Post -->
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" style="margin: 10rem auto; width: 50%; text-align: center;">
        @csrf
        <label for="title" class="visually-hidden">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title" style="margin-top: 1rem; margin-bottom: 1rem;">

        <label for="body" class="visually-hidden">Body</label>
        <input id="body" type="text" name="body" value="{{ old('body') }}" class="form-control" placeholder="Body" style="margin-top: 1rem; margin-bottom: 1rem;">

        <label for="image" class="visually-hidden">Image</label>
        <input id="image" type="file" name="image_url" value="{{ old('image_url') }}"
                             multiple accept="image/jpeg, image/png, image/gif" style="margin-top: 1rem; margin-bottom: 1rem;">

        <label for="tags" class="visually-hidden">Tags</label>
        <select id="tags" name="tags[]" multiple="multiple" class="form-select" style="margin-top: 1rem; margin-bottom: 1rem;">
            <option value="Funny">Funny</option>
            <option value="Serious">Serious</option>
            <option value="General">General</option>
            <option value="Sad">Sad</option>
        </select>

        <input class="w-100 btn btn-lg btn-primary" type="submit" value="Submit" style="margin-top: 1rem; margin-bottom: 1rem;">
        <a href="{{ route('posts.index') }}" style="margin-top: 1rem; margin-bottom: 1rem;">Cancel</a>
    </form>
@endsection
