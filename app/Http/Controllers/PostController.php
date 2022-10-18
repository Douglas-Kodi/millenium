<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Photo;

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
        if(($request->legend)or($request->hasFile('image'))){
        $newPost = new Post;
        $newPost->user_id = $request->user_id;
        $newPost->legend = $request->legend;
        $newPost->save();

            if($request->hasFile('image')){
                $destination_path = 'public/img/post/';
                $image = $request->file('image');
                $image_name = $image->GetClientOriginalName();
                $path = $request->file('image')->storeAs($destination_path,$image_name);

                $newPhoto = new Photo;
                $newPhoto->post_id = $newPost->id;
                $newPhoto->src = $image_name;
                $newPhoto->save();
            }
        }

        return $newPost;
    }
    public function update(Request $request, $id)
    {
        $existingPost = Post::find($id);

        if($existingPost){
            $existingPost->legend = $request->legend;
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
