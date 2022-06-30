<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\UserService;

class AutoUser extends Command
{
    private $userService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoUser {numOfUser}';

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
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $num = $this->argument('numOfUser');
        for($x = 0; $x < $num; $x++){
            $request = collect([
                'name' => 'name'.Str::random(3),
                'email' => Str::random(6)."@mail",
                'password' => 'password'
            ]);
            $response = $this->userService->create($request);
        }
        return 0;
    }
}