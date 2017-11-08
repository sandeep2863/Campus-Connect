<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $with = ['user'];

    protected $fillable = ['content', 'user_id'];
    //Auth::user()->post()->create(['content']);

    public function user()
    {
        return $this->belongsTo(('App\User'));
    }
}
