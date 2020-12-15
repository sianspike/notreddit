@extends('layouts.app')

@section('title', 'Post detail')

@section('content')

    <ul>
        <li>Title: {{$post -> title}}</li>
        <li>Body: {{$post -> body}}</li>
        <li>Posted by: {{$post -> user -> username}}</li>
    </ul>
@endsection
