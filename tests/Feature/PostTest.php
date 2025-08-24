<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_page_requires_authentication(): void
    {
        $response = $this->get('/posts');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_posts_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/posts');

        $response->assertStatus(200);
        $response->assertSee('Posts');
    }

    public function test_user_can_view_create_post_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/posts/create');

        $response->assertStatus(200);
        $response->assertSee('Create Post');
    }

    public function test_user_can_view_their_own_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertSee($post->title);
        $response->assertSee($post->content);
    }
}