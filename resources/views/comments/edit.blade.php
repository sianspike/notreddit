@extends('layouts.app')

@section('content')

    <!-- Edit comment -->
    <form method="POST" action="{{ route('comments.update', ['post' => $post, 'comment' => $comment]) }}" style="margin: 10rem auto; width: 50%; text-align: center;">
        @csrf
        <label for="body" class="visually-hidden">Body</label>
        <input id="body" type="text" name="body" value="{{ $comment -> body }}" class="form-control" style="margin-top: 1rem; margin-bottom: 1rem;">
        <input type="submit" value="Submit" style="margin-top: 1rem; margin-bottom: 1rem;" class="w-100 btn btn-lg btn-primary">
        <a href="{{ route('posts.show', ['post' => $post]) }}" style="margin-top: 1rem; margin-bottom: 1rem;">Cancel</a>
    </form>

    <!-- Delete comment -->
    <form method="POST" action="{{ route('comments.destroy', ['post' => $post, 'comment' => $comment]) }}" style="margin: 10rem auto; width: 50%; text-align: center;">
        @csrf
        @method('DELETE')
        <button type="submit" style="margin-top: 1rem; margin-bottom: 1rem;" class="w-100 btn btn-lg btn-danger">Delete</button>
    </form>
@endsection
