@extends('layouts.app')

@section('content')

    <!-- Add edit button to posts -->
    <div class="container">
        <ul>
            @foreach($posts as $post)
                <a href="{{ route('posts.show', ['id' => $post -> id]) }}" style="text-decoration: none; color: black">
                    <div class="card" style="width: 65rem; margin: 1rem 10rem 2rem;">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post -> title }}</h5>
                            <p class="card-text" style="color: #5c636a; display: inline-block">Posted by: {{ $post -> user -> username }}</p>
                            <p class="card-text" style="display: inline-block; color: #5c636a; margin-left: 55rem; font-size: 0.7rem">
                                {{ $post -> created_at }}
                            </p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $post -> body }}</p>
                            <img src="{{ Storage::url($post -> image_url) }}" alt="">
                        </div>
                        <!-- Add functionality to expand comments -->
                        <div class="card-footer">
                            <a href="" style="text-decoration: none; color: black"><p class="card-text">Comments</p></a>
                        </div>
                    </div>
                </a>
            @endforeach
        </ul>
    </div>

    {{ $posts -> links() }}
@endsection
