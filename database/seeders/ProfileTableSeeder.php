<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'personality'=>'abc',
                'flower_id'=>'2',
                'created_at'=>Carbon::now(),    
                // 對應 timestamps 的 created_at 列位
                'updated_at'=>Carbon::now(),    
                // 對應 timestamps 的 updated_at 列位
            ],
            [
                'personality'=>'fgchvjko',
                'flower_id'=>'3',
                'created_at' =>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'personality'=>'fgchvfvdse',
                'flower_id'=>'4',
                'created_at' =>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'personality'=>'rgdfss',
                'flower_id'=>'5',
                'created_at' =>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]
        ]);
    }
}
