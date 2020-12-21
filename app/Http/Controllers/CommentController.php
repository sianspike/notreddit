<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Notifications\UserMadeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post) {

        $notifications = Notification::all();

        $validatedData = $request -> validate([
            'comment' => 'required',
        ]);

        $user = Auth::user();

        $comment = new Comment;
        $comment -> body = $validatedData['comment'];
        $comment -> user_id = $user -> id;
        $comment -> post_id = $post -> id;
        $comment -> save();

        session() -> flash('message', 'Comment successfully created!');

        event(new UserMadeComment($user, $comment));

        return redirect() -> route('posts.show', ['post' => $post, 'notifications' => $notifications]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment) {

        $user = Auth::user();
        $notifications = Notification::all();

        if ($comment -> user_id == $user -> id || $user -> role == 'admin') {

            return view('comments.edit', ['post' => $post, 'comment' => $comment, 'notifications' => $notifications]);
        }

        session() -> flash('message', 'Not authorised to edit this comment!');
        return  redirect() -> route('posts.show', ['post' => $post, 'notifications' => $notifications]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment) {

        $validatedData = $request -> validate([
            'body' => 'required',
        ]);

        $newComment = $comment;
        $newComment -> body = $validatedData['body'];
        $newComment -> save();

        session() -> flash('message', 'Comment successfully edited!');

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment) {

        try {

            $comment -> delete();
            session() -> flash('message', 'Comment successfully deleted!');

            return redirect() -> route('posts.show', ['post' => $post]);

        } catch (\Exception $e) {

            session() -> flash('message', 'There was a problem.');
        }
    }
}
