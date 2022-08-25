<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        return Post::orderBy('created_at', 'DESC')->get();
    }
    public function create(){

    }
    public function store(Request $request)
    {
        $newPost = new Post;
        $newPost->user_id = "1";
        $newPost->legend = $request->post["legend"];
        $newPost->save();

        return $newPost;
    }
    public function update(Request $request, $id)
    {
        $existingPost = Post::find($id);

        if($existingPost){
            $existingPost->save();
            return $existingPost;
        }
    }
    public function destroy($id)
    {
        $existingPost = Post::find($id);

        if($existingPost){
            $existingPost->delete();
            return "Post successfully deleted.";
        }
        return "Post not found.";
    }
    
}
