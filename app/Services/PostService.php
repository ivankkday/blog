<?php
namespace App\Services;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;

class PostService{

    private $postRepo;

    public function __construct(PostRepository $postRepo){
        $this->postRepo = $postRepo;
    }

    public function index(){
        return $this->postRepo->index();
    }

    public function store($request, $user_id){
        $Create = $this->postRepo->create($request, $user_id);
        return $Create;
    }
    public function create($request, $id){
        $user_id = $id;
        $Create = $this->postRepo->create($request, $user_id);
        Storage::prepend('newfile.txt', $Create);
        return $Create;
    }

    public function show($id){
        return $this->postRepo->show($id);
    }

    public function update($request, $id, $user_id){
        $post = $this->postRepo->get($id); 
        // 提取當前使用者的 id  
        if($post == null){
            return response((['msg' => '留言不存在']));
        }
        if ($user_id == $post->user_id ){
            $update = $post->update($request->only(['title','content']));

            return response(['msg' => '留言內容已更新', 'data' => $update]);

        } 
        return response(['msg' => '留言更新失敗']);
    }

    public function destroy($id, $user_id){
        $post = $this->postRepo->get($id);

        if($post == null){
            return response((['msg' => '留言不存在']));
        }
        if($user_id == $post->user_id){
            $post->delete();
            return response(['msg' => '留言已刪除']);
        }
        return response(['msg' => '留言刪除失敗']);
    }

    public function like($id, $user_id){
        $post = $this->postRepo->get($id);
        $likeCollection = collect($post->likes);
        if(!$likeCollection->contains($user_id)){
            $likeCollection->push($user_id);
            $post->likes = $likeCollection;
            $post->save();
            return response(['msg' => '已按讚']);
        }
        else{
            $post->likes = $likeCollection->reject(function($element)use($user_id){
                return $element == $user_id;
            });
            $post->save();
            return response(['msg' => '已取消按讚']);
        }
    }
}