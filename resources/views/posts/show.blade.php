@extends('layouts.app')

@section('content')

    @if (session() -> has('message'))

        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{session() -> get('message')}}
        </div>
    @endif

    <!-- Post title and author -->
    <div class="card text-center border-info" style="width: 50%; margin: 1rem auto;">
        <div class="card-header">
            <a href="{{ route('posts.edit', ['post' => $post]) }}" style="display:inline-block; margin-left: 95%; font-size: 0.7rem; color: black">Edit</a>
            <h5 class="card-title">{{ $post -> title }}</h5>
            <p class="card-text" style="color: #5c636a">Posted by: {{ $post -> user -> username }}</p>
            <p class="card-text" style="display: inline-block; color: #5c636a; margin-left: 80%; font-size: 0.7rem">
                {{ $post -> created_at }}
            </p>
        </div>

        <!-- Post content -->
        <div class="card-body">
            <p class="card-text">{{ $post -> body }}</p>
            <img src="{{ Storage::url($post -> image_url) }}" alt="">
            <hr>
            @foreach($post -> tags as $tag)
                <p style="display: inline; color: #5c636a; font-size: 0.7rem">{{ $tag -> name }}</p>
            @endforeach
        </div>

        <!-- Post comments -->
        <div class="card-footer text-left">
            @foreach(($post -> comments) as $comment)
                <a href="{{ route('comments.edit', ['post' => $post, 'comment' => $comment]) }}" style="display:inline-block; margin-left: 95%; font-size: 0.7rem; color: black">Edit</a>
                <p class="card-text" style="font-size: 0.7rem; color: #5c636a">{{ $comment -> user -> username }}</p>
                <p class="card-text w-75" style="display: inline-block;">{{ $comment -> body }}</p>
                <p class="card-text" style="display: inline-block; color: #5c636a; margin-left: 80%; font-size: 0.7rem">
                    {{ $comment -> updated_at }}
                </p>
                <hr/>
            @endforeach

            <!-- Create comment -->
            <form method="POST">
                @csrf
                <label for="comment" class="visually-hidden">Comment</label>
                <input type="text" name="comment" id="comment" placeholder="New comment" class="form-control" style="margin-top: 1rem; margin-bottom: 1rem;">
                <input type="submit" value="Submit" class="submit w-100 btn btn-lg btn-primary">
            </form>
        </div>
    </div>

    <!-- Store comment using AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $(".submit").click(function(e){
                e.preventDefault();

                const _token = $("input[name='_token']").val();
                const comment = $("#comment").val();

                $.ajax({
                    url: "{{ route('comments.store', ['post' => $post, 'notifications' => $notifications]) }}",
                    type:'POST',
                    data: {_token:_token, comment:comment},
                    success: function() {
                        location.reload()
                    }
                });
            });
        });
    </script>
@endsection
