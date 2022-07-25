<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPost extends Model
{
    protected $table='posts';
    protected $fillable=['user_id', 'legend', 'deleted_at'];
    
    public function relUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function relPhotos()
    {
        return $this->hasMany('App\Models\ModelPhoto', 'post_id');
    }
    public function relLikes()
    {
        return $this->hasMany('App\Models\ModelLike', 'like_id');
    }
    public function relComments()
    {
        return $this->hasMany('App\Models\ModelComment', 'comment_id');
    }
}
