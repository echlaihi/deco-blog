<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function authenticateUser()
    {
        $user = User::factory(['is_admin' => 0])->create();
        return  $this->actingAs($user);

    }

    protected function authenticateAdmin()
    {
        $admin = User::factory(['is_admin' => 1])->create();
        return  $this->actingAs($admin);
    }
}
