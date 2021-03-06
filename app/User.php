<?php

namespace App;
use App\Traits\Friendable;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;
    use Messagable;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'gender', 'username', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }
}
