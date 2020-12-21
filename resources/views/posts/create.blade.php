@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
        <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
        <p>Image: <input type="file" name="image_url" value="{{ old('image_url') }}"
                         multiple accept="image/jpeg, image/png, image/gif"></p>
        <p>Tags: <select id="tags" name="tags[]" multiple="multiple">
                    <option value="Funny">Funny</option>
                    <option value="Serious">Serious</option>
                    <option value="General">General</option>
                    <option value="Sad">Sad</option>
                </select>
        </p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
