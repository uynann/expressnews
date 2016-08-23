<!-- header-section-starts-here -->
<div class="header">
    <div class="header-top">
        <div class="wrap clearfix">
            <div class="top-menu">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="top-menu top-menu-right">
                <ul>

                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Singup</a></li>
                    @else
                    <li class="has-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->firstname }} <span class="caret"></span>
                        </a>

                        <ul>
                            <li><a href="{{ url('/logout') }}">Logout</a></li>
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
                            <li><a href="{{ route('category', preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $category->name)))) }}">{{ $category->name }}</a></li>
                                @endforeach
                            @endif
                            <div class="clearfix"></div>
                        </ul>
                        <div class="search">
                            <!-- start search-->
                            <div class="search-box">
                                <div id="sb-search" class="sb-search">
                                    <form>
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
