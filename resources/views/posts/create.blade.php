@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
        <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
        <p>Image: <input type="file" name="image_url" value="{{ old('image_url') }}"
                         multiple accept="image/jpeg, image/png, image/gif"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
