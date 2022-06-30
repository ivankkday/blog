<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Flower;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AutoPost extends Command
{
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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $num = $this->argument('numOfPost');
        $apiTokens = Flower::all()->map(function($flower){
            return $flower->only(['api_token']);
        })->flatten()->toArray();
        for($x = 0; $x <= $num; $x++){
            $title = 'title' .' '. Str::random(10);
            $content = 'content' .' '. Str::random(10);
            $response = Http::withToken($apiTokens[array_rand($apiTokens)])
            ->post('http://blog.test/api/post', [
                'form_params'=>[
                    'title'=> $title,
                    'content'=> $content
                ]
            ])->body();
            $this->info($response);
            $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $response);
            fclose($myfile);
        }
        return 0;
    }
}
