<?php

namespace Tests\Feature\NotificationsTests;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Notifications\DatabaseNotification;

class BasicNotificationsTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp() : void 
    {
        parent::setUp();
        Category::factory(['name' => 'cat-1'])->create();
    }

    /** @test */
    public function notify_admin_when_new_user_has_registered()
    {

        $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => 1, "email" => "admin@email.com"])->createOne();

        $user = [
            "name" => "user name", 
            "email" => "user@email.com",
            "password" => "password", 
            "password_confirmation" => "password",
        ];

        $response = $this->post(route('register'), $user);
        $this->assertCount(1, $admin->notifications);

    }

    /** @test */
    public function notify_admin_when_new_post_has_created()
    {
        $admin = User::factory(['is_admin' => 1, "email" => "admin@email.com"])->createOne();
        $response = $this->authenticateAdmin();
        $post = Post::factory()->makeOne()->attributesToArray();
        
        $response = $response->post(route('post.store', $post));
        $this->assertCount(1, $admin->unreadNotifications);
    }

    /** @test */
    public function admin_call_list_all_his_notifications()
    {
        $this->withoutExceptionHandling();
        $response = $this->authenticateAdmin();
        $response = $response->get(route('notifications.list'));
        $response->assertOk();
    }

    
    /** @test */
    public function admin_can_mark_a_notification_as_read()
    {
        $response = $this->authenticateAdmin();
        $response->assertAuthenticated();
        $this->withoutExceptionHandling();
        $post = Post::factory([''])->makeOne()->attributesToArray();
        $response->post(route('post.store', $post));


        $this->assertCount(1, Post::all());
        $this->assertCount(1, DatabaseNotification::all());
        $notf_id = DatabaseNotification::first()->id;
        $response = $response->get(route('notification.read', $notf_id));
        $this->assertNotNull(DatabaseNotification::find($notf_id)->read_at);

    }


    /** @test */
    public function the_notification_to_mark_as_read_must_exist()
    {
       
        $response = $this->authenticateUser();
        $response = $this->post(route('post.store', Post::factory(['img' => 'noImage.jpeg'])->makeOne()->attributesToArray()));
        $notf_id = 'id';
       
        $response = $this->get(route('notification.read', $notf_id));
        $response->assertNotFound();
    }

    /** @test */
    public function admin_can_mark_all_his_notifications_as_read()
    {

        $this->withoutExceptionHandling();
        $response = $this->authenticateAdmin();

        $response->post(route('post.store'), Post::factory()->makeOne()->attributesToArray());
        $response->post(route('post.store'), Post::factory()->makeOne()->attributesToArray());
        $response->post(route('post.store'), Post::factory()->makeOne()->attributesToArray());

        $this->assertCount(3, auth()->user()->unreadNotifications);

        $response = $response->get(route('notification.readAll'));
        $notifications = DatabaseNotification::where('notifiable_id', 1)->where('read_at', null)->get();
        $this->assertcount(0, $notifications);
    }
}
