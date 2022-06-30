<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\CommentService;

class AutoComment extends Command
{
    private $commentService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoComment {numOfComment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CommentService $commentService)
    {
        parent::__construct();
        $this->commentService = $commentService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $num = $this->argument('numOfComment');
        $ids = User::all()->map(function($user){
            return $user->only(['id']);
        })->flatten()->toArray();
        $post_ids = Post::all()->map(function($post){
            return $post->only(['id']);
        })->flatten()->toArray();
        for($x = 0; $x < $num; $x++){
            $request = collect([
                'post_id' => $post_ids[array_rand($post_ids)],
                'content' => 'content' .' '. Str::random(10),
            ]);
            $id = $ids[array_rand($ids)];
            $response = $this->commentService->create($request, $id);
            sleep(rand(0,10));
        }
        return 0;
    }
}