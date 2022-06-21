<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'flower_id'];

    public function flower()
    {
        // 不同的 posts 為同一個 flower發布的
        return $this->belongsTo('App\Models\Flower');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
}
