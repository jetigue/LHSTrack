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
}
