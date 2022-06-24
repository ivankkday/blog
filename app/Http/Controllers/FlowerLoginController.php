<?php

namespace App\Http\Controllers;

use App\Services\FlowerService;
use Illuminate\Http\Request;
use App\Models\Flower;
use Illuminate\Support\Str;

class FlowerLoginController extends Controller
{
    private $flowerService;

    public function __construct(FlowerService $flowerService) {
        $this->flowerService = $flowerService;
    }
    public function flowerLogin (Request $request)
    {
        return $this->flowerService->flowerLogin;
    }
}
