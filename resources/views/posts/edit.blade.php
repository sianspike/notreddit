@extends('layouts.app')

@section('content')

    <!-- Edit Post -->
    <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data" style="margin: 10rem auto; width: 50%; text-align: center;">
        @csrf
        <label for="title" class="visually-hidden">Title</label>
        <input id="title" type="text" name="title" value="{{ $post -> title }}" class="form-control" style="margin-top: 1rem; margin-bottom: 1rem;">

        <label for="body" class="visually-hidden">Body</label>
        <input id="body" type="text" name="body" value="{{ $post -> body }}" class="form-control" style="margin-top: 1rem; margin-bottom: 1rem;">

        <label for="image" class="visually-hidden">Image</label>
        <input id="image" type="file" name="image_url" value="{{ $post -> image_url }}"
                         multiple accept="image/jpeg, image/png, image/gif" style="margin-top: 1rem; margin-bottom: 1rem;">

        <label for="tags" class="visually-hidden">Tags</label>
        <select id="tags" name="tags[]" multiple="multiple" style="margin-top: 1rem; margin-bottom: 1rem;" class="form-select">
            <option value="Funny">Funny</option>
            <option value="Serious">Serious</option>
            <option value="General">General</option>
            <option value="Sad">Sad</option>
        </select>

        <input type="submit" value="Submit" style="margin-top: 1rem; margin-bottom: 1rem;" class="w-100 btn btn-lg btn-primary">
        <a href="{{ route('posts.index') }}" style="margin-top: 1rem; margin-bottom: 1rem;">Cancel</a>
    </form>

    <!-- Delete Post -->
    <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}" style="margin: 10rem auto; width: 50%; text-align: center;">
        @csrf
        @method('DELETE')
        <button type="submit" style="margin-top: 1rem; margin-bottom: 1rem;" class="w-100 btn btn-lg btn-danger">Delete</button>
    </form>
@endsection
