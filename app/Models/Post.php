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
    
    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function photos() {
        return $this->hasMany('App\Models\Photo', 'post_id');
    }
    public function likes() {
        return $this->hasMany('App\Models\Like', 'like_id');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment', 'comment_id');
    }
}
