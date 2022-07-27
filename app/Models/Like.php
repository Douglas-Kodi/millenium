<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = [
        'user_id', 
        'post_id', 
        'deleted_at'
    ];
    
    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function post() {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
}
