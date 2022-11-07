<?php

namespace Database\Factories\Communication;

use App\Models\Communication\TeamAnnouncement;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamAnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamAnnouncement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'begin_date' => $this->faker->date,
            'end_date' => '2022-01-31',
            'title' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'body' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
        ];
    }
}
