<?php

namespace App\Models;

use App\Models\Category;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $guarded=[];





    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $originalSlug = $slug = str::slug($product->name);
            $counter = 1;

            while (static::whereSlug($slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $product->slug = $slug;
        });

        static::updating(function ($product) {
            // Same code here
        });
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_logo')
            ->withResponsiveImages();

    }

    public function Category(){

        return $this->belongsTo(Category::class);
    }



}

