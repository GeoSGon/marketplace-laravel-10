<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Category extends Model
{
    use HasFactory;
    use Slug;

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);

    } 
}
