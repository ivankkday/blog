<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository{

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create($request, $flower_id){
        $post = new $this->post;
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->flower_id = $flower_id;
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
            ->where('flower_id', $id)
            ->get();
    }

    public function index(){
        return $this->post->all();
    }
}