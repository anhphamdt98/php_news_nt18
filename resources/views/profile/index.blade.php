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
                        </ul>
                        <ul class="follow-me list-inline">
                            <li>{{ trans('profile.number') }} {{ trans('profile.follower-number') }}</li>  
                            <li><button class="btn-primary">{{ trans('profile.add-friend') }}</button></li>
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
                    <button class="btn-primary">{{ trans('profile.add-friend') }}</button>
                </div>
            </div>

        </div>
        <div id="page-contents">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <div class="create-post">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="" class="profile-photo-md" />
                                    <span>{{ $user->name }}</span>
                                </h4>
                            </div>
                            <form action="{{ route('post.store') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea name="caption" id="caption" cols="70" rows="6" class="form-control" placeholder="{{ trans('profile.write-post') }} "></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="tools">
                                        <ul class="publishing-tools list-inline">
                                            <li><a href="#"><i class="ion-compose"></i></a></li>
                                            <li><a href="#"><i class="ion-images"></i></a></li>
                                            <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                                            <li><a href="#"><i class="ion-map"></i></a></li>
                                        </ul>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            {{ trans('profile.publish') }}
                                        </button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="list-group">
                        @forelse ($posts as $post)
                            <div class="post-content">
                                <div class="post-date hidden-xs hidden-sm">
                                    <h5>{{ $user->name }}</h5>
                                    <p class="text-grey">{{ $post->created_at->format('d-m-Y') }}</p>
                                </div>
                                <img src="{{ asset('bower_components/bower-package/images/post-images/13.jpg') }}" alt="post-image" class="img-responsive post-image" />
                                <div class="post-container">
                                    <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5><a href="#" class="profile-link">{{ $user->name }}</a><span class="following">{{ trans('profile.following') }}</span></h5>
                                            <p class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="reaction">
                                            <a class="btn text-green"><i class="icon ion-thumbsup"></i> {{ trans('profile.like') }}</a>
                                            <a class="btn text-red"><i class="fa fa-thumbs-down"></i> {{ trans('profile.dislike') }}</a>
                                        </div>
                                        <div class="line-divider"></div>
                                        <div class="post-text">
                                            <p>{{ $post->caption }}</p>
                                        </div>
                                        <div class="line-divider"></div>
                                        <div class="post-comment">
                                            <img src="{{ asset('bower_components/bower-package/images/users/user-11.jpg') }}" class="profile-photo-sm" />
                                            <p><a href="#" class="profile-link">{{ trans('profile.username1') }} </a><i class="em em-laughing"></i>{{ trans('profile.comment1') }}</p>
                                        </div>
                                        <div class="post-comment">
                                            <img src="{{ asset('bower_components/bower-package/images/users/user-4.jpg') }}" class="profile-photo-sm" />
                                            <p><a href="#" class="profile-link">{{ trans('profile.username2') }} </a>{{ trans('profile.comment2') }}</p>
                                        </div>
                                        <div class="post-comment">
                                            <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" class="profile-photo-sm" />
                                            <input type="text" class="form-control" placeholder="{{ trans('profile.post-comment') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ trans('profile.no_post') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
