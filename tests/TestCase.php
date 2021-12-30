<?php

namespace Tests;

use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Foundation\Mix;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signInAdmin($user = null)
    {
        $role = Role::factory()->create(['name' => 'admin']);

        $this->actingAs($user ?: User::factory()->create(['user_role_id' => $role->id]));
    }

    protected function signInCoach($user = null)
    {
        $role = Role::factory()->create(['name' => 'coach']);

        $this->actingAs($user ?: User::factory()->create(['user_role_id' => $role->id]));
    }

    protected function signInAthlete($user = null)
    {
        $role = Role::factory()->create(['name' => 'athlete']);

        $this->actingAs($user ?: User::factory()->create(['user_role_id' => $role->id]));
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Swap out the Mix manifest implementation, so we don't need
        // to run the npm commands to generate a manifest file for
        // the assets in order to run tests that return views.
        $this->swap(Mix::class, function () {
            return '';
        });
    }
}
