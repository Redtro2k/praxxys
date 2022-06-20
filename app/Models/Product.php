<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories(){
        return $this->belongsTo(Category::class, 'category');
    }

    public function images(){
        return $this->morphMany(Images::class, 'imageable');
    }
}
