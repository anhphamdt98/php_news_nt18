<header id="header" class="lazy-load">
    <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">{{ trans('layouts.toggle-navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="{{ asset('bower_components/bower-package/images/logo.png') }}" alt="logo" /></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
                <li class="dropdown"><a href="#">{{ trans('layouts.home') }}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('layouts.newsfeed') }}<span><img src="{{ asset('bower_components/bower-package/images/down-arrow.png') }}" alt="" /></span></a>
                    <ul class="dropdown-menu newsfeed-home">
                        <li><a href="#">{{ trans('layouts.newsfeed') }}</a></li>
                        <li><a href="#">{{ trans('layouts.newsfeed') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('layouts.timeline') }}<span><img src="{{ asset('bower_components/bower-package/images/down-arrow.png') }}" alt="" /></span></a>
                    <ul class="dropdown-menu login">
                    <li><a href="{{ route('profile.index') }}">{{ trans('layouts.timeline') }}</a></li>
                    <li><a href="{{ route('profile.index') }}">{{ trans('layouts.timeline-friend') }}</a></li>
                    <li><a href="{{ route('profile.index') }}">{{ trans('layouts.timeline-me') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('layouts.all-pages') }} <span><img src="{{ asset('bower_components/bower-package/images/down-arrow.png') }}" alt="" /></span></a>
                    <ul class="dropdown-menu page-list">
                    <li><a href="#">{{ trans('layouts.newsfeed') }}</a></li>
                    <li><a href="#">{{ trans('layouts.timeline') }}</a></li>
                    <li><a href="#">{{ trans('layouts.timeline-friend') }}</a></li>
                    <li><a href="#">{{ trans('layouts.timeline-me') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">{{ trans('layouts.contact') }}</a></li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm">
            <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="{{ trans('layouts.search') }}">
            </div>
            </form>
        </div>
        </div>
    </nav>
</header>
