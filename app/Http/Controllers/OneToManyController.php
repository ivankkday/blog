<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Post;

class OneToManyController extends Controller
{
    function OneToMany ($id)
    {
        $post = Post::where('flower_id',$id)
            ->with('flower')
            ->get();

        return $post;
    }
}
