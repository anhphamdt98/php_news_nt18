<header id="header" class="visible">
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
                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('layouts.newsfeed') }} <span><img src="{{ asset('bower_components/bower-package/images/down-arrow.png') }}" alt="" /></span></a>
                            <ul class="dropdown-menu newsfeed-home">
                                <li><a href="#">{{ trans('layouts.newsfeed') }}</a></li>
                                <li><a href="#">{{ trans('layouts.newsfeed') }}</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('layouts.timeline') }} <span><img src="{{ asset('bower_components/bower-package/images/down-arrow.png') }}" alt="" /></span></a>
                            <ul class="dropdown-menu login">
                                <li><a href="{{ route('profile.index',['userId'=>Auth::user()->id]) }}">{{ trans('layouts.timeline') }}</a></li>
                                <li><a href="{{ route('profile.index',['userId'=>Auth::user()->id]) }}">{{ trans('layouts.timeline-friend') }}</a></li>
                                <li><a href="{{ route('profile.index',['userId'=>Auth::user()->id]) }}">{{ trans('layouts.timeline-me') }}</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="dropdown"><a href="#">{{ trans('layouts.contact') }}</a></li>
                    @guest
                        <li class="nav-item dropdown">
                            <a href="{{ route('login') }}" class="nav-link" aria-expanded="false">{{ trans('layouts.login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item dropdown">
                                <a href="{{ route('register') }}" class="nav-link" aria-expanded="false">{{ trans('layouts.register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span><img src="{{ asset('bower_components/bower-package/images/down-arrow.png') }}" alt="" /></span>
                            </a>
                            <ul class="dropdown-menu ">
                                <li>     
                                    <a class="dropdown-item" href="{{ route('logout') }}" >
                                        {{ trans('layouts.logout') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
                @if (Auth::check())
                    <form class="navbar-form navbar-right hidden-sm">
                        <div class="form-group">
                            <i class="icon ion-android-search"></i>
                            <input type="text" class="form-control" placeholder="{{ trans('layouts.search') }}">
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </nav>
</header>
