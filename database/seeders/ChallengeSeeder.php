<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 5; $i++) {
            $challenge = [
                'title' => 'title' . $i,
                'is_completed' => 0,
                'user_id' => rand(1, 10),
                'start_day' =>  date("Y/m/d"),
                'end_day' =>  date("Y/m/d", strtotime('+29 day')),

            ];
            \Illuminate\Support\Facades\DB::table('challenges')->insert($challenge);
        }
    }
}
