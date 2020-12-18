@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('comments.update', ['post' => $post, 'comment' => $comment]) }}">
        @csrf
        <p>Body: <input type="text" name="body" value="{{ $comment -> body }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['post' => $post]) }}">Cancel</a>
    </form>
@endsection
