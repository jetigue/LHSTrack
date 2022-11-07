<?php

namespace Database\Factories\Communication;

use App\Models\Communication\TeamEvent;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'event_date' => '2022-01-'.$this->faker->numberBetween(1, 30),
            'title' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $this->faker->sentence($nbSentences = 7, $variableNbSentences = true),
        ];
    }
}
