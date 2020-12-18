@extends('layouts.app')

@section('content')

    <div class="card" style="width: 65rem; margin: 1rem 10rem 2rem;">
        <div class="card-header">
            <a href="{{ route('posts.edit', ['post' => $post]) }}" style="display:inline-block; margin-left: 61rem; font-size: 0.7rem; color: black">Edit</a>
            <h5 class="card-title">{{ $post -> title }}</h5>
            <p class="card-text" style="color: #5c636a">Posted by: {{ $post -> user -> username }}</p>
            <p class="card-text" style="display: inline-block; color: #5c636a; margin-left: 55rem; font-size: 0.7rem">
                {{ $post -> created_at }}
            </p>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $post -> body }}</p>
            <img src="{{ Storage::url($post -> image_url) }}" alt="">
        </div>

        <div class="card-footer">
            @foreach(($post -> comments) as $comment)
                <a href="{{ route('comments.edit', ['post' => $post, 'comment' => $comment]) }}" style="display:inline-block; margin-left: 61rem; font-size: 0.7rem; color: black">Edit</a>
                <p class="card-text" style="font-size: 0.7rem; color: #5c636a">{{ $comment -> user -> username }}</p>
                <p class="card-text w-75" style="display: inline-block;">{{ $comment -> body }}</p>
                <p class="card-text" style="display: inline-block; margin-left: 55rem; font-size: 0.7rem; color: #5c636a">
                    {{ $comment -> updated_at }}
                </p>
                <hr/>
            @endforeach

            <form method="POST">
                @csrf
                <p><input type="text" name="comment" id="comment"></p>
                <input type="submit" value="Submit" class="submit">
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $(".submit").click(function(e){
                e.preventDefault();

                const _token = $("input[name='_token']").val();
                const comment = $("#comment").val();

                $.ajax({
                    url: "{{ route('comments.store', ['post' => $post]) }}",
                    type:'POST',
                    data: {_token:_token, comment:comment},
                    success: function(data) {
                        location.reload()
                    }
                });
            });
        });
    </script>
@endsection
