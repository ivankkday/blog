<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'created_at' => Carbon::now(),    // 對應 timestamps 的 created_at 列位
                'updated_at' => Carbon::now(),    // 對應 timestamps 的 updated_at 列位
                'title' => 'sun',
                'content' => '17',
                'flower_id' => '1',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'air',
                'content' => '3',
                'flower_id' => '1',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'water',
                'content' => '3',
                'flower_id' => '1',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'soil',
                'content' => '18',
                'flower_id' => '1',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'blood',
                'content' => '17',
                'flower_id' => '1',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'salt',
                'content' => '10',
                'flower_id' => '3',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'poison',
                'content' => '17',
                'flower_id' => '2',
            ],
            [
                'created_at' => Carbon::now(),    
                'updated_at' => Carbon::now(),    
                'title' => 'water',
                'content' => '8',
                'flower_id' => '3',
            ],
        ]);
    }
}
