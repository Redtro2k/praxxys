<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Images extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImage(){
        return Storage::url($this->img);
    }

    public function imageable(){
        return $this->morphTo();
    }
    
}
