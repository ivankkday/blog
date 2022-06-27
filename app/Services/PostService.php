<?php
namespace App\Services;
use App\Repositories\PostRepository;

class PostService{

    private $postRepo;

    public function __construct(PostRepository $postRepo){
        $this->postRepo = $postRepo;
    }

    public function store($request, $flower_id){
        $Create = $this->postRepo->create($request, $flower_id);
        return $Create;
    }

    public function show($id){
        return $this->postRepo->show($id);
    }

    public function update($request, $id, $flower_id){
        $post = $this->postRepo->get($id); 
        // 提取當前使用者的 id  
        if($post == null){
            return response((['msg' => '留言不存在']));
        }
        if ($flower_id == $post->flower_id ){
            $update = $post->update($request->only(['title','content']));

            return response(['msg' => '留言內容已更新', 'data' => $update]);

        } 
        return response(['msg' => '留言更新失敗']);
    }

    public function destroy($id, $flower_id){
        $post = $this->postRepo->get($id);

        if($post == null){
            return response((['msg' => '留言不存在']));
        }
        if($flower_id == $post->flower_id){
            $post->delete();
            return response(['msg' => '留言已刪除']);
        }
        return response(['msg' => '留言刪除失敗']);
    }

    public function like($id, $flower_id){
        $post = $this->postRepo->get($id);
        $likeCollection = collect($post->likes);
        if(!$likeCollection->contains($flower_id)){
            $likeCollection->push($flower_id);
            $post->likes = $likeCollection;
            $post->save();
            return response(['msg' => '已按讚']);
        }
        else{
            $post->likes = $likeCollection->reject(function($element)use($flower_id){
                return $element == $flower_id;
            });
            $post->save();
            return response(['msg' => '已取消按讚']);
        }
    }
}