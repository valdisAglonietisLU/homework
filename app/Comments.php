<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'Comments';

    public function news(){
        return $this->belongsTo('App\News', 'news_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
