@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
        @csrf
        <p>Title: <input type="text" name="title" value="{{ $post -> title }}"></p>
        <p>Body: <input type="text" name="body" value="{{ $post -> body }}"></p>
        <p>Image: <input type="file" name="image_url" value="{{ $post -> image_url }}"
                         multiple accept="image/jpeg, image/png, image/gif"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
