<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostAction
{
    public function deletePhotos(Post $post)
    {
        Storage::delete([$post->image, $post->thumbnail_image]);
    }
}
