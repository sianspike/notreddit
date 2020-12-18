<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $posts = Post::paginate(15);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedData = $request-> validate([
            'title' => 'required|max:100',
            'body' => 'required',
        ]);
        $user = Auth::user();
        $path = "";

        if ($request -> hasFile('image_url')) {

            $path = $request -> file('image_url') -> store('public/images');
        }

        $post = new Post;
        $post -> title = $validatedData['title'];
        $post -> body = $validatedData['body'];
        $post -> image_url = $path;
        $post -> user_id = $user -> id;

        $post -> save();

        session() -> flash('message', 'Post successfully created!');

        return redirect() -> route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {

        $user = Auth::user();

        if ($post -> user_id == $user -> id) {

            return view('posts.edit', ['post' => $post]);
        }

        session() -> flash('message', 'Not authorised to edit this post!');
        return redirect() -> route('posts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {

        $validatedData = $request-> validate([
            'title' => 'required|max:100',
            'body' => 'required',
        ]);

        $path = "";

        if ($request -> hasFile('image_url')) {

            $path = $request -> file('image_url') -> store('public/images');
        }

        $newPost = $post;
        $newPost -> title = $validatedData['title'];
        $newPost -> body = $validatedData['body'];
        $newPost -> image_url = $path;
        $newPost -> user_id = $post -> user_id;

        $newPost -> save();

        session() -> flash('message', 'Post successfully updated!');

        return redirect() -> route('posts.index');
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
