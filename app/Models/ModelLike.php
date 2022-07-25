<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLike extends Model
{
    protected $table='likes';
    protected $fillable=['user_id', 'post_id', 'deleted_at'];
    
    public function relUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function relPost()
    {
        return $this->hasOne('App\Models\ModelPost', 'id', 'post_id');
    }
}
