<?php

namespace App\Models;
// namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User;

class PostComment extends Model
{
    // use HasFactory;
    protected $fillable=["post_id","user_id","title","message","approved"];

    public function user(){
        // dd($this->belongsTo(User::class));
        return $this->belongsTo('App\Models\User');
    }

    // public function category(){
    //     // pertenece
    //     return $this->belongsTo(Category::class);
    // }
}
