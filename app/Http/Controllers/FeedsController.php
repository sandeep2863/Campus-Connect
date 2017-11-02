<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedsController extends Controller
{
    public function feed()
    {
        $friends = Auth::user()->friends();
        $feed = array();

        foreach ($friends as $friend):
            foreach ($friend->posts as $post):
                array_push($feed, $post);
            endforeach;
        endforeach;

        return $feed;
    }
}
