<?php

namespace App\Console\Commands;

use App\Services\MotcApiAuthService;
use Illuminate\Console\Command;

class externalApi extends Command
{

    private $motcApiAuthService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testExternal';

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
        $this->motcApiAuthService = new MotcApiAuthService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->motcApiAuthService->test();
        return $response;
    }
}
