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
                <div class="col-md-7">
                    <div class="create-post">
                        <div class="card">
                            @if (Auth::user()->id == $user->id)
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
                            @endif
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
                                        
                                        @include('post.commentDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

                                        <div class="post-comment">
                                            <form method="post" action="{{ route('comment.store') }}">
                                                @method('POST')
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-md-1 avatar-user">
                                                        <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" class="profile-photo-sm" />
                                                    </div>
                                                    <div class="col-md-11 layout-comment-input">
                                                        <a href="#" class="profile-link">{{ Auth::user()->name }}</a>
                                                        <textarea class="form-control" name="comment" cols="45" rows="3" placeholder="{{ trans('profile.post-comment') }}"></textarea>
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                                                        <button type="submit" class="btn btn-primary" value="Comment"><i class="fa fa-comment" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>           
                                            </form>
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
