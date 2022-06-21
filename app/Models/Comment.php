<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        // 不同的 comments 為回覆同一個 post
        return $this->belongsTo('App\Models\Post');
    }

    public function flower()
    {
        // 不同的 comments 為同一個 flower發布的
        return $this->belongsTo('App\Models\Flower');
    }
}
