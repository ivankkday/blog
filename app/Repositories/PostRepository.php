<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository{

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create($request, $user_id){
        $post = new $this->post;
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->user_id = $user_id;
        $post->save();
        return $post->fresh();
    }
    public function get($id) {
        return $this->post
            ->where('id', $id)
            ->first();
    }

    public function show($id){
        return $this->post
            ->where('user_id', $id)
            ->get();
    }

    public function index(){
        return $this->post->all();
    }
}