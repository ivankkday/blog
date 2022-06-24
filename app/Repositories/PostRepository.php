<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository{

    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function create($request, $flower_id){
        $Create= Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'flower_id' => $flower_id,
        ]);
        return $Create;
    }

    public function show($id){
        $show = $this->post->where('flower_id', $id);
        return $show;
    }
}