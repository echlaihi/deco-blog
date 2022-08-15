<?php

namespace Tests\Feature\UserTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BasicUserTest extends TestCase
{
    
    use RefreshDatabase;

    public function admin_can_list_all_the_new_users()
    {
        $this->withoutExceptionHandling();
        User::factory(20)->create();
        $admin = User::factory(['is_admin' => 1])->create();
        $response = $this->actingAs($admin);
        $response = $response->get(route('dashboard'));
        $response->assertSee('new_users');
    }

    /** @test */
    public function admin_can_delete_a_regular_user()
    {
        $this->withoutExceptionHandling();
        $response = $this->authenticateAdmin();
        $regular_user = User::factory(['is_admin' => 0])->create();
        $response = $response->delete(route('user.delete', 2));
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function a_user_can_see_his_profile_info_in_a_form() 
    {
        $this->withoutExceptionHandling();
        $response = $this->authenticateUser();
        $response = $response->get(route('user.edit-profile'));
        $response->assertOk();

    }

    /** @test */
    public function a_user_can_update_his_password()
    {

        $this->withoutExceptionHandling();
       $response = $this->authenticateUser();
        $response = $response->get(route('user.edit-profile'));
        $response->assertOk();

        $response = $this->put(route('user-password.update', 1), ['current_password' => 'password', 'password' => 'newpassword', 'password_confirmation' => 'newpassword']);


       $response = $this->post(route('logout'));
       $response->assertRedirect('/');
        $response = $this->post(route('login'), ['email' => User::first()->email, 'password' => 'newpassword']);
    }

    /** @test */
    public function a_user_can_update_his_profile_informations()
    {
        $this->withoutExceptionHandling();
        $response = $this->authenticateUser();
        $response = $response->put(route('user-profile-information.update', 1), [ 
        'name' => 'new name', 
        'email' => 'newemail@email.com',
    ]);

        $this->assertEquals(User::first()->name, 'new name');
        $this->assertEquals(User::first()->email, 'newemail@email.com');
    }


    /** @test */
    public function admin_can_list_all_the_users()
    {
        $this->withoutExceptionHandling();
        $users = User::factory(20)->create();
        $admin = User::factory(['is_admin' => 1])->create();
        $response = $this->actingAs($admin);
        $response = $this->get(route('dashboard.users'));
        $response->assertOk();

    }

        /** @test */
    public function a_user_can_delete_his_account()
    {
        $this->withoutExceptionHandling();
        $response = $this->authenticateUser();
        $response = $response->delete(route('user.delete', 1));
        $this->assertCount(0, User::all());
        $response->assertRedirect(route('login'));
        
    }
     
}
