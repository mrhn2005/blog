<?php

namespace App\Models;

use App\Models\QueryBuilders\PostQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function newEloquentBuilder($query): PostQueryBuilder
    {
        return new PostQueryBuilder($query);
    }

    //Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Accessors
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 100, '...');
    }

    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return null;
        }

        return Storage::url($this->image);
    }

    public function getThumbnailImageAttribute()
    {
        if (! $this->image) {
            return null;
        }

        $prod['item_image_url'] = "new-thumb-01.jpg";

        $fileparts = pathinfo($this->image);

        return $fileparts['dirname'] . '/'  . $fileparts['filename'] . "_100x100." . $fileparts['extension'];
    }

    public function getThumbnailImageUrlAttribute()
    {
        if (! $this->image) {
            return null;
        }

        return Storage::url($this->thumbnail_image);
    }
}
