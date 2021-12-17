<?php

namespace Database\Factories;

use App\Actions\PostAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence;

        $post = collect($this->faker->paragraphs(rand(5, 15)))
            ->map(function($item){
                return "<p>$item</p>";
            })->implode('');

        $imageLocationFormat = app(PostAction::class)->imageLocationFormat();

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'content' => $post,
            'image' => $imageLocationFormat . '/' . $this->faker->image(
                Storage::path($imageLocationFormat),500,500, null, false
            ),
        ];
    }
}
