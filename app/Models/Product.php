<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, Sluggable;

    // fillable
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'stock',
        'is_in_stock',
        'category_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImage()
    {
        return $this->image ? Storage::disk('s3')->url('uploads/products/' . $this->image) : 'https://via.placeholder.com/300x300.png?text=No+Image';
    }
}
