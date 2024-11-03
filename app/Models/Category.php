<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categotry) {
            $originalSlug = $slug = str::slug($categotry->title);
            $counter = 1;

            while (static::whereSlug($slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $categotry->slug = $slug;
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
        $this->addMediaCollection('category_logo')
            ->withResponsiveImages();

    }


    public function product(){
return $this->hasMany(Product::class,'category_id','id');
    }


}
