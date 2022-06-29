<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id){
        $post = Post::find($id);
        $user_id=Auth::user()->id;
        $likeCollection = collect($post->likes);
        if(!$likeCollection->contains($user_id)){
            $likeCollection->push($user_id);
            $post->likes = $likeCollection;
            $post->save();
            return response(['msg' => '已按讚']);
        }
        else{
            $post->likes = $likeCollection->reject(function($element)use($user_id){
                return $element == $user_id;
            });
            $post->save();
            return response(['msg' => '已取消按讚']);
        }
    }
}
