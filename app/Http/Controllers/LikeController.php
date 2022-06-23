<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id){
        $post = Post::find($id);
        $flower_id=Auth::user()->id;
        $likeCollection = collect($post->likes);
        if(!$likeCollection->contains($flower_id)){
            $likeCollection->push($flower_id);
            $post->likes = $likeCollection;
            $post->save();
            return response(['msg' => '已按讚']);
        }
        $post->likes = $likeCollection->reject(function($element)use($flower_id){
            return $element == $flower_id;
        });
        $post->save();
        return response(['msg' => '已取消按讚']);
    }
}
