<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\PostService;

class LikeController extends Controller {

    private $postService;
    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }
    
    public function like($id){
        $user_id=Auth::user()->id;
        $response = $this->postService->like($id, $user_id);
        return $response;
    }
}
