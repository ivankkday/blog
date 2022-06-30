<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository{

    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function create($request, $user_id){
        $comment = new $this->comment;
        $comment->content = $request['content'];
        $comment->post_id = $request['post_id'];
        $comment->user_id = $user_id;
        $comment->save();
        return $comment->fresh();
    }
    public function get($id) {
        return $this->comment
            ->where('id', $id)
            ->first();
    }

    public function show($id){
        return $this->comment
            ->where('user_id', $id)
            ->get();
    }

    public function index(){
        return $this->comment->all();
    }
}