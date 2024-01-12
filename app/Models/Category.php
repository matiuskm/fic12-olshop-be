<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImage(): string
    {
        return $this->image ? Storage::disk('s3')->url('uploads/' . $this->image) : 'https://via.placeholder.com/1200x600.png?text=No+Image';
    }
}
