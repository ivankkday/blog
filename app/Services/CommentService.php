<?php
namespace App\Services;
use App\Repositories\CommentRepository;

class CommentService{

    private $commentRepo;

    public function __construct(CommentRepository $commentRepo){
        $this->commentRepo = $commentRepo;
    }

    public function store($request, $user_id){
        $Create = $this->commentRepo->create($request, $user_id);
        return $Create;
    }
    public function create($request, $id){
        $user_id = $id;
        $Create = $this->commentRepo->create($request, $user_id);
        return $Create;
    }

    public function show($id){
        return $this->commentRepo->show($id);
    }
}