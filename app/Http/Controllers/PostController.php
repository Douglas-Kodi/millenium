<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::orderBy('created_at', 'DESC')->where('deleted_at', '=', null)->get();
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        $newPost = new Post;
        $newPost->user_id = $request->post["user_id"];
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
            $existingPost->deleted_at = date("Y-m-d\TH:i:s");
            $existingPost->save();
            return "Post successfully deleted.";
        }
        return "Post not found.";
    }
    
}
