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
    protected $signature = 'testExternal {--H|health} {--F|format=JSON}';

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
        $health = $this->option('health') == true? true : false;
        $format = $this->option('format') == "XML"? "XML":"JSON";
        $response = $this->motcApiAuthService->test($health, $format);
        return $response;
    }
}
