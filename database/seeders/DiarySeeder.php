<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 20; $i++) {
            $diary = [
                'comment' => 'comment' . $i,
                'comment_day' => $i,
                'challenge_id' => 1,
            ];
            \Illuminate\Support\Facades\DB::table('diaries')->insert($diary);
        }
        for ($i = 0; $i <= 20; $i++) {
            $diary = [
                'comment' => 'comment' . $i,
                'comment_day' => $i,
                'challenge_id' => 2,
            ];
            \Illuminate\Support\Facades\DB::table('diaries')->insert($diary);
        }
    }
}
