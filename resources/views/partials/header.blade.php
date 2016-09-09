<!-- header-section-starts-here -->
<div class="header">
    <div class="header-top">
        <div class="wrap clearfix">
            <div class="small-menu small-menu-left">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                </ul>

                @if((Auth::check()))
                    @if(Auth::user()->role->name == 'Administrator')
                    <ul class="admin-menu">
                        <li><a>&#124;</a></li>
                        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li class="has-submenu"><a><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;New</a>

                            <ul>
                                <li><a href="{{ url('/admin/posts/create') }}">Post</a></li>
                                <li><a href="{{ url('/admin/categories') }}">Category</a></li>
                                <li><a href="{{ url('/admin/tags') }}">Tag</a></li>
                                <li><a href="{{ url('/admin/medias/create') }}">Media</a></li>
                                <li><a href="{{ url('/admin/users/create') }}">User</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                @endif

            </div>

            <div class="small-menu small-menu-right">
                <ul class="auth-menu">
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Singup</a></li>
                    @else
                    <li class="has-submenu"><a>{{ Auth::user()->username }}  <img src="{{ isset(Auth::user()->photo->file_path) ? asset(Auth::user()->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }}" alt=""></a>

                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="logo text-center">
            <a href="{{ url('/') }}"><img src="{{ asset('assets/logo.jpg') }}" alt="" /></a>
        </div>
        <div class="navigation">
            <nav class="navbar navbar-default" role="navigation">
                <div class="wrap">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <!--/.navbar-header-->

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            @if(isset($categories))
                                @foreach($categories as $category)
                            <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            @endif
                            <div class="clearfix"></div>
                        </ul>
                        <div class="search">
                            <!-- start search-->
                            <div class="search-box">
                                <div id="sb-search" class="sb-search">
                                    <form action="{{ url('/search') }}">
                                        <input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
                                        <input class="sb-search-submit" type="submit" value="">
                                        <span class="sb-icon-search"> </span>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--/.navbar-collapse-->
                <!--/.navbar-->
                </div>
            </nav>
    </div>
</div>
