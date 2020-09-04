@foreach ($comments as $comment)
    <div class="line-divider"></div>
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
        <a href="" id="reply"></a>
        @if (is_null($comment->parent_id) )
            @include('post.commentDisplay', ['comments' => $comment->replies])
            <form method="POST" action="{{ route('comment.store') }}">
                @csrf
                <div class="form-group layout-comment row" >
                    <div class="col-md-1 avatar-user">
                        <img src="{{ asset(config('media.image') . Auth::user()->avatar) }}" class="profile-photo-sm" />
                    </div>
                    <div class="col-md-11 layout-comment-input">
                        <a href="#" class="profile-link">{{ Auth::user()->name }}</a>
                        <input class="form-control" name="comment" placeholder="{{ trans('profile.post-comment') }}">
                        <input type="hidden" name="post_id" value="{{ $post_id }}" />
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                        <button type="submit" class="btn btn-warning reply-button">
                            <i class="fa fa-comments"></i>
                        </button>                  
                </div>
            </form>
        @endif
    </div>
@endforeach
