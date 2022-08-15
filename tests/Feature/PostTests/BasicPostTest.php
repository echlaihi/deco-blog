<?php

namespace Tests\Feature\PostTests;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class BasicPostTest extends TestCase
{
     use RefreshDatabase;

     protected function setUp() : void
     {
          parent::setUp();
          Category::factory(['name' => 'cat-1'])->create();
     }

      /** @test */
      public function a_create_post_form_can_be_rendered()
      {
          $this->withExceptionHandling();
           $response = $this->authenticateUser();
           $response = $this->get(route('post.create'));
           $response->assertOk();
           $response->assertViewIs('posts.create');
      }
 
      /** @test  */
      public function a_post_having_an_img_can_be_stored()
      {
          
          $this->withoutExceptionHandling();
           // create a fake image
           $img = UploadedFile::fake()->image('img', 1000, 500)->size(500);
           Category::factory()->create();
           $post = Post::factory(['img' => $img])->makeOne()->attributesToArray();
          //  dd($post);
          
           $response = $this->authenticateUser();

           $response = $response->post(route('post.store'), $post);
 
           $this->assertCount(1, Post::all());
           Storage::disk('public')->assertExists($img->hashName());
           $this->assertEquals(Post::first()->img, $img->hashName());
 
      }
 
      /** @test */
      public function a_post_that_does_not_have_img_can_be_stored_in_database()
      {
           $this->withoutExceptionHandling();
           $response = $this->authenticateUser();
           $post = Post::factory()->make()->attributesToArray();
           $response = $response->post(route('post.store'), $post);
 
           $this->assertCount(1, Post::all());
      }
 
 
      /** @test */
      public function a_post_can_be_rendered()
      {
            Post::factory()->createOne();
            User::factory()->createOne();
           $response = $this->get(route('post.show', 1));
 
           $response->assertOk();
           $response->assertViewIs('posts.show');
      }
 
      /** @test */
      public function all_the_posts_can_be_rendered_by_category_id()
      {
           $this->withoutExceptionHandling();
           User::factory()->createOne();
           Category::create([
               'name' => 'cat1',
           ]);
          $posts = Post::factory(10)->create();
 
           $response = $this->get(route('post.index', 1));
 
           $response->assertOk();
           $response->assertViewIs('posts.index');
      }
 
      /** @test */
      public function edit_post_form_can_be_rendered()
      {
           $post = Post::factory()->createOne();

           $response = $this->authenticateUser();
           $response = $this->get(route('post.edit',1));
           $response->assertOk();
      }
 
      /** @test */
      public function a_post_can_be_updated()
      {
           $this->withoutExceptionHandling();
           $post = Post::factory()->create();
           $image = UploadedFile::fake()->image("myImage.jpeg", 1000, 100)->size(1000);
           
           $updated_post = Post::factory(['img' => $image])->make()->attributesToArray();
           
           $response = $this->authenticateUser();
           $response->assertAuthenticated();
           $response = $this->put(route('post.update', 1), $updated_post);
 
 
           $this->assertEquals(Post::first()->title, $updated_post['title']);
           $this->assertEquals(Post::first()->body, $updated_post['body']);
           $this->assertEquals($image->hashName(), Post::first()->img);
           $response->assertRedirect(route("post.show", 1));
      }
 
      /** @test */
      public function if_the_user_does_not_add_an_image_in_the_edit_form_image_should_not_be_updated()
      {
           $post = Post::factory()->make()->attributesToArray();
           $img = UploadedFile::fake()->image('img.jpg', 1000, 500)->size(1000);
           $post['img'] = $img;
          
           $response = $this->authenticateUser();

           $response = $this->post(route("post.store"), $post);
           $post_updated = Post::factory()->make()->attributesToArray();
           $response = $this->put(route("post.update", 1), $post_updated);
 
           $image = Post::first()->only(["img"]);
           $image = $image["img"];
 
           $this->assertEquals($image, $img->hashName());
      }
 
      /** @test */
      public function a_post_can_be_destroyed()
      {
 
          Post::factory()->create();
          $response = $this->authenticateUser();

          $response = $this->delete(route('post.destory', 1));
 
           $this->assertCount(0, Post::all());
      }
      /** @test */
      public function a_user_can_search_for_a_post()
      {
          $this->withoutExceptionHandling();
          Post::factory(10)->create();
          $response = $this->get(route('post.search'), ['query' => 'hello world']);
          $response->assertOk();
      }

}
