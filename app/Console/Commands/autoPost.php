<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Flower;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Services\PostService;

class AutoPost extends Command
{
    private $postService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoPost {numOfPost}';

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
    public function __construct()
    {
        parent::__construct();
        $this->postService = new PostService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $num = $this->argument('numOfPost');
        $ids = Flower::all()->map(function($flower){
            return $flower->only(['id']);
        })->flatten()->toArray();

        // $apiTokens = Flower::all()->map(function($flower){
        //     return $flower->only(['api_token']);
        // })->flatten()->toArray();
        for($x = 0; $x < $num; $x++){
            $request = collect([
                'title' => 'title' .' '. Str::random(10),
                'content' => 'content' .' '. Str::random(10),
            ]);
            $id = $ids[array_rand($ids)];
            $response = $this->postService->create($request, $id);
            // $response = Http::withToken($apiTokens[array_rand($apiTokens)])
            // ->post('http://blog.test/api/post', [
            //     'form_params'=>[
            //         'title'=> $title,
            //         'content'=> $content
            //     ]
            // ])->body();
        }
        return 0;
    }
}
