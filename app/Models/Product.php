<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected static function booted()
    {
        static::updating(function ($product) {
            if ($product->isDirty('image')) {
                $oldImage = $product->getOriginal('image');

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            // editor image  update
            $oldContent = $product->getOriginal('content');
            $newContent = $product->content;

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

        static::deleting(function ($product) {
            if (! $product->isForceDeleting()) {
                return;
            }
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            preg_match_all('/storage\/(.*?)"/', $product->content, $matches);
            $images = $matches[1] ?? [];

            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        });
    }
}