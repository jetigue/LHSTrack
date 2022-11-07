<?php

namespace Database\Factories\Properties\Meets\Track;

use App\Models\Properties\Meets\Track\MeetName;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetNameFactory extends Factory
{
    protected $model = MeetName::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name().' '.'Invitational',
        ];
    }
}
