<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Services\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function index()
    {
        return response(['msg' => $this->postService->index()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:2|max:200',       // 標題要求格式或限制
            'content' => 'required|string|min:2|max:1000'     // 內文要求格式或限制
        ]);
        $user_id = Auth::user()->id;     // Auth::user()->使用者某欄資料
        $Create = $this->postService->store($request, $user_id);
        $user_name= Auth::user()->name;
        $msg = $request->only(['title','content']);    
        if ($Create)
            return response([$user_name, $msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->show($id);
        if(!is_null($post)) {
            return response(['data' => $post]);
        }
        else {
        return response(['message' => 'Post not found']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id=Auth::user()->id;  
        return $this->postService->update($request, $id, $user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user_id=Auth::user()->id;
        return $this->postService->destroy($id, $user_id);
    }
}
