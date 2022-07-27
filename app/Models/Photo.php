<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = [
        'post_id', 
        'src', 
        'deleted_at'
    ];
    
    public function post() {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
}

