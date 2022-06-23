<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'flower_id'];
    protected $casts = [
        'likes' => 'collection'
    ];
    public function flower()
    {
        // 不同的 posts 為同一個 flower發布的
        return $this->belongsTo('App\Models\Flower');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    // public function where($key, $value){
    //     return Post::where($key, $value);
    // }
}
