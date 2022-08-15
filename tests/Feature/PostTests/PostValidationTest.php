<?php

namespace Tests\Feature\PostTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostValidationTest extends TestCase
{

   use RefreshDatabase;
   /** @test */
   public function post_id_in_request_must_be_integer()
   {

       $post = Post::factory()->create();
       $response = $this->get(route('post.show', 'k'));
       $response->assertStatus(404);

   }

   /** @test */
   public function the_post_id_passed_in_request_must_belongs_to_a_post_in_database()
   {
       $id = 9;
       $response = $this->get(route('post.show',$id));
       $response->assertNotFound();
   }

}
