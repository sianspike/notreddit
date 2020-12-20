<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    private $type;
    private $data;
    private $user_id;
    private $recipient_id;

    public function user() {

        return $this->belongsTo('App\Models\User');
    }
}
