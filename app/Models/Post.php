<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'user_id'];
    protected $casts = [
        'likes' => 'collection'
    ];
    public function user()
    {
        // 不同的 posts 為同一個 user發布的
        return $this->belongsTo('App\Models\User');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
}
