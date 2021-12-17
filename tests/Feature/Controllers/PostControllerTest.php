<?php

namespace Tests\Feature\Controllers;

use App\Actions\PostAction;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cant_see_posts()
    {
        $this->get(route('posts.index'))
            ->assertRedirect('/login');
    }

    public function test_authenticated_user_can_see_posts()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('posts.index'))
            ->assertStatus(200);
    }

    public function test_admin_user_can_see_edit_and_delete_button()
    {
        $user = User::factory(2)->create()->admins()->first();
        Post::factory()->for($user)->create();

        $this->actingAs($user)
            ->get(route('posts.index'))
            ->assertStatus(200)
            ->assertSee('Edit')
            ->assertSee('Delete');
    }

    public function test_regular_user_cant_see_edit_and_delete_button()
    {
        $user = User::factory()->create();
        Post::factory()->for($user)->create();

        $this->actingAs($user)
            ->get(route('posts.index'))
            ->assertStatus(200)
            ->assertDontSee('Edit')
            ->assertDontSee('Delete');
    }

    public function test_admin_user_can_create_post()
    {
        $user = User::factory(2)->create()->admins()->first();

        $inputs = [
            'title' => 'test',
            'content' => '<p>Test Content</p>',
            'image' => UploadedFile::fake()->image('avatar.jpg', 500, 500),
        ];

        $this->actingAs($user)
            ->post(route('posts.store'), $inputs);

        $this->assertDatabaseHas('posts', Arr::except($inputs, 'image'));

        $post = $user->posts()->first();

        $this->assertFileExists(Storage::path($post->image));

        //clean-up
        app(PostAction::class)->deletePhotos($post);
    }
}
