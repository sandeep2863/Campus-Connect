<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        return Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);
    }
}
