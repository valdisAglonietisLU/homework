<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'News';

    public function comments(){
        return $this->hasMany('App\Comments', 'news_id')->orderBy('Comments.created_at', 'DESC');
    }
}
