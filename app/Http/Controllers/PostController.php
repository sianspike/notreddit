<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $posts = Post::paginate(15);
        $notifications = Notification::all();
        $tags = Tag::all();

        return view('posts.index', ['posts' => $posts, 'notifications' => $notifications, 'tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $notifications = Notification::all();
        $tags = Tag::all();

        return view('posts.create', ['notifications' => $notifications, 'tags' => $tags]);
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
        $tags = Tag::all();
        $chosenTags = $request -> tags;

        if ($request -> hasFile('image_url')) {

            $path = $request -> file('image_url') -> store('public/images');
        }

        $post = new Post;
        $post -> title = $validatedData['title'];
        $post -> body = $validatedData['body'];
        $post -> image_url = $path;
        $post -> user_id = $user -> id;
        $post -> save();

        foreach($chosenTags as $chosenTag) {

            foreach($tags as $tag) {

                if ($chosenTag == $tag -> name) {

                    $tag -> posts() -> attach($post -> id);
                }
            }
        }

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

        $notifications = Notification::all();

        return view('posts.show', ['post' => $post, 'notifications' => $notifications]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {

        $user = Auth::user();
        $tags = Tag::all();
        $notifications = Notification::all();

        if ($post -> user_id == $user -> id || $user -> role == 'admin') {

            return view('posts.edit', ['post' => $post, 'tags' => $tags, 'notifications' => $notifications]);
        }

        session() -> flash('message', 'Not authorised to edit this post!');
        return redirect() -> route('posts.index', ['tags' => $tags, 'notifications' => $notifications]);
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
        $tags = Tag::all();
        $chosenTags = $request -> tags;

        if ($chosenTags != null) {

            foreach($tags as $tag) {

                $tag -> posts() -> detach($post -> id);
            }
        }

        if ($request -> hasFile('image_url')) {

            $path = $request -> file('image_url') -> store('public/images');
        }

        $newPost = $post;
        $newPost -> title = $validatedData['title'];
        $newPost -> body = $validatedData['body'];
        $newPost -> image_url = $path;
        $newPost -> user_id = $post -> user_id;
        $newPost -> save();

        foreach($chosenTags as $chosenTag) {

            foreach($tags as $tag) {

                if ($chosenTag == $tag -> name) {

                    try {

                        $tag -> posts() -> attach($post -> id);

                    } catch (QueryException $e) {


                    }
                }
            }
        }

        session() -> flash('message', 'Post successfully updated!');

        return redirect() -> route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post) {

        try {

            $post -> delete();
            session() -> flash('message', 'Post successfully deleted!');

            return redirect() -> route('posts.index');

        } catch (\Exception $e) {

            session() -> flash('message', 'There was a problem.');
        }
    }
}
