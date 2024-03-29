@extends('layouts.app')

@section('content')

    @if (session() -> has('message'))

        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{session() -> get('message')}}
        </div>
    @endif

    <div class="container">
        <ul>
            @foreach($posts as $post)

                <!-- Post title and author -->
                <div class="card text-center border-info" style="width: 50%; margin: 1rem auto;">
                    <div class="card-header">
                        <a href="{{ route('posts.edit', ['post' => $post]) }}" style="display:inline-block; margin-left: 95%; font-size: 0.7rem; color: black">Edit</a>
                        <h5 class="card-title">{{ $post -> title }}</h5>
                        <p class="card-text" style="color: #5c636a; display: inline-block">Posted by: {{ $post -> user -> username }}</p>
                        <p class="card-text" style="display: inline-block; color: #5c636a; margin-left: 80%; font-size: 0.7rem">
                            {{ $post -> updated_at }}
                        </p>
                    </div>

                    <!-- Post content -->
                    <a href="{{ route('posts.show', ['post' => $post]) }}" style="text-decoration: none; color: black">
                        <div class="card-body">
                            <p class="card-text">{{ $post -> body }}</p>
                            <img src="{{ Storage::url($post -> image_url) }}" alt="">
                        </div>
                    </a>

                    <!-- Tags -->
                    <div class="card-footer">
                        @foreach($post -> tags as $tag)
                            <p style="display: inline">{{ $tag -> name }}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </ul>
    </div>

    {{ $posts -> links() }}
@endsection
