<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like($id)
    {
        $post = Post::find($id);

        return Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);
    }

    public function unlike($id)
    {
        $post = Post::find($id);

        Like::where('user_id', Auth::id())->where('post_id', $post->id)->first()->delete();

        return 1;
    }
}
