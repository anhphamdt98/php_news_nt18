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
                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-inline profile-menu">
                            <li>
                                <a href="#" class="active">{{ trans('profile.timeline') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('profile.about') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('profile.album') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('profile.friends') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.followers', ['userId' => $user->id]) }}" class="active">{{ trans('profile.followers') }}
                                    <span class="badge badge-primary">{{ $user->followers()->get()->count() }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.following', ['userId' => $user->id]) }}" class="active">{{ trans('profile.following') }}
                                    <span class="badge badge-primary">{{ $user->following()->get()->count() }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="follow-me list-inline">    
                            @if (Auth::id() != $user->id)
                                @if (auth()->user()->isFollowing($user))
                                    <li>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.unfollow', ['userId' => $user->id]) }}">
                                            @csrf
                                            <input type="hidden" name="userId" value={{ $user->id }}>
                                            <button type="submit" class="btn-primary">{{ trans('profile.unfollow') }}</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.follow', ['userId' => $user->id]) }}">
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
                        <li>
                            <a href="#" class="active">{{ trans('profile.timeline') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('profile.about') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('profile.album') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('profile.friends') }}</a>
                        </li>
                    </ul>
                    <button class="btn-primary">{{ trans('profile.follow') }}</button>
                </div>
            </div>
        </div>
        <div id="page-contents">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    
                    <div class="list-group">
                        
                            <div class="post-content">
                                <div class="post-date hidden-xs hidden-sm">
                                    <h5>
                                        <strong>{{ $user->name }}</strong>
                                    </h5>
                                    <p class="text-grey">{{ $post->created_at->format('d-m-Y') }}</p>
                                </div>
                                <div class="post-container">
                                    <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5>
                                                <strong>
                                                    <a href="#" class="profile-link">{{ $user->name }}</a>
                                                </strong>
                                            </h5>
                                            <p class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="reaction">
                                            <a class="btn text-green">
                                                <i class="icon ion-thumbsup"></i> {{ trans('profile.like') }}
                                            </a>
                                            <a class="btn text-red">
                                                <i class="fa fa-thumbs-down"></i> {{ trans('profile.dislike') }}
                                            </a>
                                        </div>
                                        <div class="line-divider"></div>

                                        <form action="{{ route('post.update', ['postId' => $post->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="post-media media-layouts">
                                                @foreach ($post->media as $media)
                                                    <tr>
                                                        <td>
                                                            @foreach (json_decode($media->url) as $picture)
                                                                <img class="media-styles" src="{{ asset(config('media.image') . $picture) }}"/>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <div class="tools">
                                                    <ul class="publishing-tools list-inline">
                                                        <li><i class="fa fa-camera"></i></li>
                                                        <li><input type="file" class="form-control" name="url[]" multiple></li>
                                                        <button type="submit" class="btn btn-primary pull-right">
                                                            {{ trans('profile.publish') }}
                                                        </button>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="post-text caption">
                                                <textarea name="caption" type="text"  cols="70" rows="6" class="form-control" >{{ $post->caption }}</textarea>
                                            </div>
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>

                                        @foreach ($post->comments as $comment)
                                            @if ($comment->parent_id == null)
                                                <div class="line-divider"></div>
                                            @endif
                                            <div class="display-comment @if ($comment->parent_id != null) layout-comment @endif">
                                                <div class="post-comment row">
                                                    <div class="col-md-1 avatar-user">
                                                        <img src="{{ asset(config('media.image') . $comment->user->avatar) }}" class="profile-photo-sm" />
                                                    </div>            
                                                    <div class="col-md-11 layout-avatar">
                                                        <a href="#" class="profile-link">{{ $comment->user->name }}</a>
                                                        <p>{{ $comment->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
