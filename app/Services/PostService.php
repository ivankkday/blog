<?php
namespace App\Services;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostService{

    private $postRepo;

    public function __construct(){
        $this->postRepo = new PostRepository();
    }

    public function store($request){
        $request->validate([
            'title' => 'required|string|min:2|max:200',       // 標題要求格式或限制
            'content' => 'required|string|min:2|max:1000'     // 內文要求格式或限制
        ]);
        $flower_id = Auth::user()->id;     // Auth::user()->使用者某欄資料
        $Create = $this->postRepo->create($request, $flower_id);
        return $Create;
    }
    public function create($request, $id){
        $flower_id = $id;
        $Create = $this->postRepo->create($request, $flower_id);
        return $Create;
    }

    public function show($id){
        return Post::where('flower_id',$id)->get();
    }

    public function update($request, $id){
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

    public function destroy($id){
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