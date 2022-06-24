<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class LikeController extends Controller {

    private $postService;
    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }
    
    public function like($id){

        $response = $this->postService->like($id);
        return $response;
    }
}
