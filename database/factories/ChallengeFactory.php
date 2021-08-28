<?php

namespace Database\Factories;

use App\Models\Challenge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Challenge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'title' . rand(1, 100),
            'is_completed' => 0,
            'user_id' => rand(1, 10),
            'start_day' =>  date("Y/m/d"),
            'end_day' =>  date("Y/m/d", strtotime('+29 day')),
        ];
    }
}
