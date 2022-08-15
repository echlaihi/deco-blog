<?php

namespace Tests\Feature\PostTests;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostAuthorizationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function non_authenticated_user_cannot_create_store_update_delete_a_post()
    {
        $post = Post::factory()->makeOne()->attributesToArray();

        $response = array();

        $response[0] = $this->get(route('post.create'));
        $response[1] = $this->get(route('post.edit', 1));
        $response[2] = $this->post(route('post.store'), $post);
        $response[3] = $this->put(route('post.update', 1), $post);
        $response[4] = $this->delete(route('post.destory', 1));

        for($i=0; $i < 5; $i++){
            $response[$i]->assertRedirect(route('login'));
        }
        
    }

    /** @test */
    public function regular_user_cannot_edit_update_delete_does_not_belongs_to_him()
    {

        $users = User::factory(2)->create();
        $post1 = Post::factory()->create(['user_id' => 1, 'img' => 'noImage.jpg']);
        $post2 = Post::factory()->create(['user_id' => 2, 'img' => 'noImage.jpg']);

        // dd($post2->user_id);

        $this->assertCount(2, Post::all());
        $this->assertCount(2, User::all());

        
        $updated_post = Post::factory()->make()->attributesToArray();

       $authUser = $this->authenticateUser();


        $response1 = $authUser->get(route('post.edit', 2));
        $response2 = $authUser->put(route('post.update', 2), []);
        $response3 = $authUser->delete(route('post.destory', 2));

        $response1->assertForbidden();
        $response2->assertForbidden();
        $response3->assertForbidden();

       

    }


    ########################
    #### admin previlges ###
    #######################


      /** @test */
      public function dashboard_panel_can_be_rendered()
      {
          $response = $this->authenticateAdmin();
          $response = $this->get(route('dashboard'));
          $response->assertOk();
          $response->assertViewIs('admin.dashboard');
      }
  
      /** @test */
      public function admin_can_delete_any_post()
      {
          $response = $this->authenticateAdmin();
          Post::factory(['user_id' => 2, 'img' => 'noImage.jpeg'])->createOne();
          $response = $response->delete(route('post.destory', 1));
          $response->assertRedirect();
      }
  
      /** @test */
      public function admin_can_update_any_post()
      {
          Category::factory(['name' => 'cat-1'])->create();
          $this->withoutExceptionHandling();
          $response = $this->authenticateAdmin();
          
          $user = User::factory()->create();
          $post = Post::factory(['user_id' => 2])->create();

          $post = Post::factory()->createOne()->attributesToArray();
          $response = $response->put(route('post.update', 1), $post);
          $this->assertEquals(Post::first()->body, $post['body']);
          $response->assertRedirect();
  
      }
  
      /** @test
       */
      public function admin_can_list_all_posts()
      {
          $response = $this->authenticateAdmin();
          $response = $this->get(route("dashboard.posts"));
          $response->assertOk();
      }

}
