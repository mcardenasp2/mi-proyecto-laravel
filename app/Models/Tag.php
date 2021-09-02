<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        // return $this->belongsToMany(Post::class);
        return $this->morphedByMany(Post::class,'taggable');

    }
    public function users(){
        // return $this->belongsToMany(Post::class);
        return $this->morphedByMany(User::class,'taggable');

    }
}
