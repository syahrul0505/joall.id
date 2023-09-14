<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'categories_id', 'stock', 'price', 'description', 'slug', 'photos'
    ];

    protected $hidden = [
        
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}