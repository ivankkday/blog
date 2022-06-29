<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('comments')->insert(
            [
                [
                    'user_id'=> '3',
                    'post_id'=> '2',
                    'content'=>'content1',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'user_id'=> '3',
                    'post_id'=> '5',
                    'content'=>'content2',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'user_id'=> '1',
                    'post_id'=> '2',
                    'content'=>'content3',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'user_id'=> '3',
                    'post_id'=> '2',
                    'content'=>'content4',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'user_id'=> '2',
                    'post_id'=> '2',
                    'content'=>'content5',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'user_id'=> '1',
                    'post_id'=> '1',
                    'content'=>'content6',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
            ]);
    }
}
