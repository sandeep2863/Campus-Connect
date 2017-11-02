@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        {{ $user->name }}'s Profile
                    </p>
                </div>
                <div class="panel-body">
                    <center>
                        <img src="{{ $user->avatar }}" width="140px" height="140px" style="border-radius: 50%;" alt="Avatar">
                    </center>
                    <p class="text-center">
                        {{ $user->profile->location }}
                    </p>
                    <br><br>
                    <p class="text-center">
                        @if(Auth::id() == $user->id)
                            <a class="btn btn-lg btn-info" href="{{ route('profile.edit') }}">Edit Profile</a>
                        @endif
                    </p>
                </div>
            </div>

            @if(Auth::id() != $user->id)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">
                            <strong>Connection Status<strong>
                        </p>
                    </div>
                    <div class="panel-body">
                        <friend :profile_user_id="{{ $user->id }}"></friend>
                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        About Me
                    </p>
                </div>
                <div class="panel-body">
                    <p class="text-center">
                        {{ $user->profile->about }}
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection