<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'user_id', 
        'legend', 
        'deleted_at'
    ];
    
    public function User(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function Photos()
    {
        return $this->hasMany('App\Models\Photo', 'post_id');
    }
    public function Likes()
    {
        return $this->hasMany('App\Models\Like', 'like_id');
    }
    public function Comments()
    {
        return $this->hasMany('App\Models\Comment', 'comment_id');
    }
}
