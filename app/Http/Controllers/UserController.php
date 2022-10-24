<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::where('deleted_at', '=', null)->get();
    }
    public function show()
    {

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
