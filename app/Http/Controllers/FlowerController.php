<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlowerService;

class FlowerController extends Controller
{
    
    private $flowerService;

    public function __construct(FlowerService $flowerService){
        $this->flowerService = $flowerService;
    }

    public function index()
    {
        return $this->flowerService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([//驗證規則
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:flowers'],
            'password' => ['required', 'string', 'min:6','max:12'],
        ]);
        $Create = $this->flowerService->create($request);
        if($Create)
            return "註冊成功...$Create->api_token";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name',
            'email' => 'unique:users|email',
            'password',
        ]);
        $this->flowerService->update($request);
        return  $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->flowerService->destroy($id);
    }
}
