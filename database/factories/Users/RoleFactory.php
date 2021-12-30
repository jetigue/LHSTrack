<?php

namespace Database\Factories\Users;

use App\Models\Users\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{

    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'athlete', 'coach', 'admin', 'parent', 'booster', 'viewer'
            ])
        ];
    }


    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'admin',
            ];
        });
    }

    /**
 * Indicate that the user is suspended.
 *
 * @return Factory
 */
    public function isCoach(): Factory
    {
        return $this->state(function () {
            return [
                'name' => 'coach',
            ];
        });
    }

    public function athlete()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'athlete',
            ];
        });
    }

    public function booster()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'booster',
            ];
        });
    }
}
