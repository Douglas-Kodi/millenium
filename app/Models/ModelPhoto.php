<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPhoto extends Model
{
    protected $table='photos';
    protected $fillable=['post_id', 'src', 'deleted_at'];
    
    public function relPost()
    {
        return $this->hasOne('App\Models\ModelPost', 'id', 'post_id');
    }
}
