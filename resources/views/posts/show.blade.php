@extends('layouts.app')

@section('content')

    <!-- Add edit button to post-->
    <div class="card" style="width: 65rem; margin: 1rem 10rem 2rem;">
        <div class="card-header">
            <h5 class="card-title">{{ $post -> title }}</h5>
            <p class="card-text" style="color: #5c636a">Posted by: {{ $post -> user -> username }}</p>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $post -> body }}</p>
            <img src="{{ Storage::url($post -> image_url) }}">
        </div>
        <!-- Convert to AJAX -->
        <!-- Add edit button to comments -->
        <div class="card-footer">
            @foreach(($post -> comments) as $comment)
                <p class="card-text" style="font-size: 0.7rem; color: #5c636a">{{ $comment -> user -> username }}</p>
                <p class="card-text w-75" style="display: inline-block;">{{ $comment -> body }}</p>
                <p class="card-text" style="display: inline-block; margin-left: 55rem; font-size: 0.7rem; color: #5c636a">
                    {{ $comment -> created_at }}
                </p>
                <hr/>
            @endforeach

            <form method="POST" action="{{ route('comments.store', ['id' => $post -> id]) }}">
                @csrf
                <p><input type="text" name="comment"></p>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection
