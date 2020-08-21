@extends('layouts.app')
@section('content')
<div class="container">
    <div class="timeline">
        <div id="page-contents">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-card">
                        <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="user" class="profile-photo" />
                        <h5><a href="#" class="text-white">{{ Auth::user()->name }}</a></h5>
                        <a href="{{ route('profile.followers', ['userId' => $user->id]) }}" class="text-white">
                            <i class="ion ion-android-person-add"></i>
                            {{ $user->followers()->get()->count() }} {{ trans('profile.followers') }}
                        </a>
                    </div>
                    <ul class="nav-news-feed">
                        <li>
                            <i class="icon ion-ios-paper"></i>
                            <div>
                                <a href="newsfeed.html">My Newsfeed</a>
                            </div>
                        </li>
                        <li>
                            <i class="icon ion-ios-people-outline"></i>
                            <div>
                                <a href="newsfeed-friends.html">Friends</a>
                            </div>
                        </li>
                        <li>
                            <i class="icon ion-chatboxes"></i>
                            <div>
                                <a href="newsfeed-messages.html">Messages</a>
                            </div>
                        </li>
                        <li>
                            <i class="icon ion-images"></i>
                            <div>
                                <a href="newsfeed-images.html">Images</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div class="create-post">
                        <div class="card">
                            @if (Auth::id() == $user->id)
                                <form action="{{ route('post.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea name="caption" id="caption" cols="70" rows="6" class="form-control" placeholder="{{ trans('profile.write-post') }} "></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer">
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
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="list-group">
                        @foreach ($posts as $post)
                            <div class="post-content">
                                <div class="post-container">
                                    <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5>
                                                <strong>
                                                    <a href="#" class="profile-link">{{ $post->user->name }}</a>
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
                                        </div>
                                        <div class="post-text caption">
                                            <p><strong>{{ $post->caption }}</strong></p>
                                        </div>
                                        
                                        @include('post.commentDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                                        
                                        <div class="line-divider"></div>
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
                                                        <input class="form-control comment-input-style" name="comment" placeholder="{{ trans('profile.post-comment') }}" autocomplete="off">
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
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2 static">
                    <div class="suggestions" id="sticky-sidebar">
                        <h4 class="grey">Who to Follow</h4>
                        @foreach ($unfollowUsers as $user)
                            @if (Auth::id() != $user->id)
                                <div class="follow-user">
                                    <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }} " alt="" class="profile-photo-sm pull-left" />
                                    <div>
                                        <h5><a href="timeline.html">{{ $user->name }}</a></h5>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.follow', ['userId' => $user->id]) }}">
                                            @csrf
                                            <input type="hidden" name="userId" value={{ $user->id }}>
                                            <button type="submit" class="btn-primary">{{ trans('profile.follow') }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
