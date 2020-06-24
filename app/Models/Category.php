<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Category extends Model
{
    protected $fillable = ['name'];

    public function post(){
      return $this->hasMany(Post::class);
    }
    
}
