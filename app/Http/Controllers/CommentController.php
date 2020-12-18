<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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

        $validatedData = $request -> validate([
            'comment' => 'required',
        ]);

        $user = Auth::user();

        $comment = new Comment;
        $comment -> body = $validatedData['comment'];
        $comment -> user_id = $user -> id;
        $comment -> post_id = $post -> id;
        $comment -> save();

        session() -> flash('message', 'Comment succesfully created!');

        return redirect() -> route('posts.show', ['post' => $post]);
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

        if ($comment -> user_id == $user -> id) {

            return view('comments.edit', ['post' => $post, 'comment' => $comment]);
        }

        session() -> flash('message', 'Not authorised to edit this comment!');
        return  redirect() -> route('posts.show', ['post' => $post]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
