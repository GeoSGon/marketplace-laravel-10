<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Product extends Model
{
    use HasFactory;
    use Slug;

    protected $fillable = [
        'name',
        'description',
        'body',
        'price',
        'slug',
    ];

    public function getThumbAttribute()
    {
        return $this->images->first()->image;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);

    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
