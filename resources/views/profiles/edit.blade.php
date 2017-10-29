@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Profile</div>

                    <div class="panel-body">
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="avatar">Upload Avatar</label>
                                <input type="file" name="avatar" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location">Location</label>
                                <input type="text" name="location" value="{{ $info->location }}" class="form-control" required>
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                <label for="about">About Me</label>
                                <textarea name="about" id="about" cols="30" rows="10" class="form-control" required>{{ $info->about }}</textarea>
                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <p class="text-center">
                                    <button class="btn btn-lg btn-primary" type="submit">
                                        Save
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
