<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(['msg' =>Post::get()]);
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


        $flower_id = Auth::user()->id;     // Auth::user()->使用者某欄資料

        $Create=Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'flower_id' => $flower_id,
            'likes' => [],
        ]);

        $flower_name= Auth::user()->name;
        $msg = $request->only(['title','content']);    


        if ($Create)
            return response([$flower_name, $msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flower_id=$id;
        $post =Post::where('flower_id',$flower_id)->get();

        if(!is_null($post)) {
            return response(['data' => $post]);
        }
        else {
        return response(['message' => 'Post not found']);
        }
    }

    public function search($content){
        $post = Post::all();
        $inTitle = $post->filter(function($item) use($content){
            return str_contains($item->title, $content);
        });
        $inContent = $post->filter(function($item) use($content){
            return str_contains($item->content, $content);
        });
        $response = $inTitle->merge($inContent)
                            ->sortByDesc(function($item){
                                return count($item->likes);
                            });
        return response(['data' => $response]);
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
        //
        $post = Post::find($id);
        $flower_id=Auth::user()->id;   
        // 提取當前使用者的 id  
        if($post == null){
            return response((['msg' => '留言不存在']));
        }
        if ($flower_id == $post->flower_id ){
            $update = $post->update($request->only(['title','content']));

            return response(['msg' => '留言內容已更新', 'data' => $update]);

        } else {
            return response(['msg' => '留言更新失敗']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $flower_id=Auth::user()->id;

        if($post == null){
            return response((['msg' => '留言不存在']));
        }
        if($flower_id == $post->flower_id){
            $post->delete();
            return response(['msg' => '留言已刪除']);
        }
        return response(['msg' => '留言刪除失敗']);
    }
}
