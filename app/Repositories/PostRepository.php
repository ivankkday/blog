<?php
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository{

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create($request, $flower_id){
        $Create= $this->post->save([
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