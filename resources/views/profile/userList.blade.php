@extends('layouts.app')
@section('content')
<div class="container">
    <div class="timeline">
        <div class="timeline-cover">
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-info">
                            <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="" class="img-responsive profile-photo" />
                            <h3>{{ $user->name }}</h3> 
                            <p class="text-muted">{{ trans('profile.status') }}</p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-inline profile-menu">
                            <li><a href="#" class="active">{{ trans('profile.timeline') }}</a></li>
                            <li><a href="#">{{ trans('profile.about') }}</a></li>
                            <li><a href="#">{{ trans('profile.album') }}</a></li>
                            <li><a href="#">{{ trans('profile.friends') }}</a></li>
                            <li><a href="{{ route('profile.followers', ['userId'=>$user->id]) }}" class="active">{{ trans('profile.followers') }}<span class="badge badge-primary">{{ $user->followers()->get()->count() }}</span></a></li>
                            <li><a href="{{ route('profile.following', ['userId'=>$user->id]) }}" class="active">{{ trans('profile.following') }}<span class="badge badge-primary">{{ $user->following()->get()->count() }}</span></a></li>
                        </ul>
                        <ul class="follow-me list-inline">    
                            @if (Auth::user()->id != $user->id)
                                @if (auth()->user()->isFollowing($user))
                                    <li>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.unfollow', ['userId'=>$user->id])}}">
                                            @csrf
                                            <input type="hidden" name="userId" value={{ $user->id }}>
                                            <button type="submit" class="btn-primary">{{ trans('profile.unfollow') }}</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.follow', ['userId'=>$user->id])}}">
                                            @csrf
                                            <input type="hidden" name="userId" value={{ $user->id }}>
                                            <button type="submit" class="btn-primary">{{ trans('profile.follow') }}</button>
                                        </form>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                    <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="" class="img-responsive profile-photo" />
                    <h3>{{ $user->name }}</h3>  
                    {{ trans('profile.status') }}
                </div>
                <div class="mobile-menu">
                    <ul class="list-inline">
                        <li><a href="#" class="active">{{ trans('profile.timeline') }}</a></li>
                        <li><a href="#">{{ trans('profile.about') }}</a></li>
                        <li><a href="#">{{ trans('profile.album') }}</a></li>
                        <li><a href="#">{{ trans('profile.friends') }}</a></li>
                    </ul>
                    <button class="btn-primary">{{ trans('profile.follow') }}</button>
                </div>
            </div>
        </div>
        <div id="page-contents">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="friend-list">
                        @if ($other->count())
                            @foreach($other as $other)
                                <div class="col-2 profile-box border p-1 rounded text-center bg-light mr-4 mt-3">
                                    <div class="row" style="margin-bottom: 30px">
                                        <div class="col-md-2" style="margin-right: -50px">
                                            <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="" class="img-responsive profile-photo" />
                                        </div>
                                        <div class="col-md-1">
                                            <h5 class="m-0"><a href="{{ route('profile.index', $other->id) }}"><strong>{{ $other->name }}</strong></a></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <p class="mb-2">
                                                    <small>Followers: <span class="badge badge-primary tl-follower">{{ $other->followers()->get()->count() }}</span></small>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="mb-2">
                                                    <small>Following: <span class="badge badge-primary">{{ $other->following()->get()->count() }}</span></small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if (Auth::user()->id != $other->id)
                                                @if (Auth::user()->isFollowing($other))
                                                    <form method="POST" class="form-horizontal" action="{{ route('profile.unfollow', ['userId'=>$other->id])}}">
                                                        @csrf
                                                        <input type="hidden" name="userId" value={{ $other->id }}>
                                                        <button type="submit" class="btn-primary">{{ trans('profile.unfollow') }}</button>
                                                    </form>
                                                @else
                                                    <form method="POST" class="form-horizontal" action="{{ route('profile.follow', ['userId'=>$other->id])}}">
                                                        @csrf
                                                        <input type="hidden" name="userId" value={{ $other->id }}>
                                                        <button type="submit" class="btn-primary">{{ trans('profile.follow') }}</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
