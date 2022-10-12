<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {

    }
    public function show($id)
    {
        return Photo::where('post_id', '=', $id)->get();
    }
    public function create()
    {

    }
    public function store(Request $request)
    {

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}
