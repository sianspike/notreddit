<?php

namespace App\Http\Controllers;


use App\Models\Notification;

class NotificationController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        return view('posts.index');
    }

    public function destroy(Notification $notification) {

        try {

            $notification -> delete();

            return redirect() -> back();

        } catch (\Exception $e) {

            session() -> flash('message', 'There was a problem.');
        }
    }
}
