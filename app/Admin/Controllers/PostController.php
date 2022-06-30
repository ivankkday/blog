<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('標題'));
        $grid->column('content', __('內容'));
        $grid->column('user_id', __('User id'))
            ->style('max-width:55px;word-break:break-all;');
        $grid->column('created_at', __('發佈時間'));
        $grid->column('updated_at', __('更新時間'))
        ->sortable();
        $grid->column('deleted_at', __('刪除時間'));
        $grid->column('likes', __('Likes'))
            ->sortable();
        $grid->column('num_of_comment', __('留言數'))
            ->display(function(){
                return count($this->comment()->get());
            })
            ->style('max-width:55px;word-break:break-all;');
        $grid->column('comments')->modal('最新留言', function ($model) {

            $comments = $model->comment()->take(10)->get()->map(function ($comment) {
                $comment['user'] = User::find($comment['user_id'])->name;
                return $comment->only(['user', 'content', 'created_at']);
            });
        
            return new Table(['留言者', '内容', '發布時間'], $comments->toArray());
        });
            
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('likes', __('Likes'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());
        $form->column(1/2, function($form){
            $form->text('title', __('Title'));
            $form->textarea('content', __('Content'));
            $form->number('user_id', __('User id'));
            $form->text('likes', __('Likes'));
        });
        $form->column(1/2, function($form){
            $form->hasMany('comment', function (Form\NestedForm $form) {
                $form->number('user_id');
                $form->text('content');
            });
        });
        return $form;
    }
}
