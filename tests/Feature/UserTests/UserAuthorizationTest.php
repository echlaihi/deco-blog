<?php

namespace Tests\Feature\UserTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserAuthorizationTest extends TestCase
{
   use RefreshDatabase;

   
    /** @test */
    public function non_admin_users_cannot_list_all_the_users()
    {
        $users = User::factory(20)->create();
        $user = User::factory(['is_admin' => 0])->create();
        $response = $this->actingAs($user);

        $response = $this->get(route('dashboard.users'));
        $response->assertNotFound();
    }


 

    /** @test */
    public function non_admin_users_cannot_delete_another_user()
    {
        $user = User::factory()->create();
        User::factory()->create();
        $response = $this->actingAs($user);
        $response = $response->delete(route('user.delete', 2));
        $response->assertForbidden();
        $this->assertCount(2, User::all());
        
    }

    /** @test */
    public function admin_cannot_delete_admin_user()
    {   
        $admin = User::factory(['is_admin' => 1])->create();
        User::factory(['is_admin' => 1])->create();
        $response = $this->actingAs($admin);
        $response = $response->delete(route('user.delete', 2));
        $response->assertForbidden();
        $this->assertCount(2, User::all());
    }
}
