<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Photo;
use App\Models\Like;
use App\Models\Comment;
use App\Http\Middleware;

class FeedController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('Index');
        $this->objUser =new User();
        $this->objPost =new Post();
        $this->objPhoto =new Photo();
        $this->objLike =new Like();
        $this->objComment =new Comment();
    }

    public function index()
    {
        $post=$this->objPost->paginate(12);
        return view('app', compact('post')); 
    }
}
