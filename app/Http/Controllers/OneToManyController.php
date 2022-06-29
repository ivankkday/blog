<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class OneToManyController extends Controller
{
    function OneToMany ($id)
    {
        $post = Post::where('user_id',$id)
            ->with('user')
            ->get();

        return $post;
    }
}
