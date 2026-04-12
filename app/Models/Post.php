<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title',
        'slug',
        'category_id',
        'color',
        'content',
        'image', 'published',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'date',
    ];

    protected static function booted()
    {
        // normal image update
        static::updating(function ($post) {

            if ($post->isDirty('image')) {
                $oldImage = $post->getOriginal('image');

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // editor image  update

            $oldContent = $post->getOriginal('content');
            $newContent = $post->content;

            preg_match_all('/storage\/(.*?)"/', $oldContent, $oldMatches);
            preg_match_all('/storage\/(.*?)"/', $newContent, $newMatches);

            $oldImages = $oldMatches[1] ?? [];
            $newImages = $newMatches[1] ?? [];

            $deletedImages = array_diff($oldImages, $newImages);

            foreach ($deletedImages as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }

        });

        static::deleting(function ($post) {
            if (! $post->isForceDeleting()) {
                return;
            }
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            preg_match_all('/storage\/(.*?)"/', $post->content, $matches);

            $images = $matches[1] ?? [];

            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        });
    }
}
