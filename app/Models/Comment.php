<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    private $body;
    private $user_id;
    private $post_id;
    private $post;

    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function post() {

        return $this->belongsTo('App\Models\Post');
    }
}
