<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //use HasFactory;
    protected $fillable = ['title', 'url_clean', 'content','category_id','posted'];

    public function category(){
        // pertenece
        return $this->belongsTo(Category::class);
    }

    public function image(){
        return $this->hasOne(PostImage::class);
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
}
