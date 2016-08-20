<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="{{asset('css/admin/vendor.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/app-default.css')}}">



        <!-- Theme initialization -->
        <script>
var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
{};
var themeName = themeSettings.themeName || '';
if (themeName)
{
    document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');

}
else
{
    document.write('<link rel="stylesheet" id="theme-style" href="{{ asset('css/app-default.css') }}">');
}
        </script>

        @yield('styles')

        <link rel="stylesheet" href="{{asset('css/admin/styles.css')}}">
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
                        <i class="fa fa-bars"></i>
                        </button> </div>
                    <div class="header-block header-block-search hidden-sm-down">
                        <form role="search">
                            <div class="input-container"> <i class="fa fa-search"></i> <input type="search" placeholder="Search">
                                <div class="underline"></div>
                            </div>
                        </form>
                    </div>

                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <sup>
                                    <span class="counter">8</span>
                                    </sup> </a>
                                <div class="dropdown-menu notifications-dropdown-menu">
                                    <ul class="notifications-container">
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('assets/faces/3.jpg')"></div>
                                                </div>
                                                <div class="body-col">
                                                    <p> <span class="accent">Zack Alien</span> pushed new commit: <span class="accent">Fix page load performance issue</span>. </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('assets/faces/5.jpg')"></div>
                                                </div>
                                                <div class="body-col">
                                                    <p> <span class="accent">Amaya Hatsumi</span> started new task: <span class="accent">Dashboard UI design.</span>. </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('assets/faces/8.jpg')"></div>
                                                </div>
                                                <div class="body-col">
                                                    <p> <span class="accent">Andy Nouman</span> deployed new version of <span class="accent">NodeJS REST Api V3</span> </p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <footer>
                                        <ul>
                                            <li> <a href="">
                                                View All
                                                </a> </li>
                                        </ul>
                                    </footer>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url({{ isset(Auth::user()->photo->file_path) ? asset(Auth::user()->photo->file_path) : 'https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg' }})"> </div> <span class="name">
                                    {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}
                                    </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="{{route('admin.users.edit', Auth::user()->id) }}"> <i class="fa fa-user icon"></i> Profile </a>
                                    <a class="dropdown-item" href="#"> <i class="fa fa-bell icon"></i> Notifications </a>
                                    <a class="dropdown-item" href="#"> <i class="fa fa-gear icon"></i> Settings </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/logout') }}"> <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> Code Hacking </div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li class="active">
                                    <a href="/admin"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-file-text-o"></i> Posts <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="{{route('admin.posts.index')}}">
                                            All Posts
                                            </a> </li>
                                        <li> <a href="{{route('admin.posts.create')}}">
                                            Add New
                                            </a> </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="{{ route('admin.categories.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Categories</a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.tags.index') }}"> <i class="fa fa-tags" aria-hidden="true"></i> Tags</a>
                                </li>

                                <li>
                                    <a href=""> <i class="fa fa-user"></i> Media <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="{{route('admin.medias.index')}}">
                                            Media Library
                                            </a> </li>
                                        <li> <a href="{{route('admin.medias.create')}}">
                                            Add New
                                            </a> </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href=""> <i class="fa fa-user"></i> Users <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="{{route('admin.users.index')}}">
                                            All Users
                                            </a> </li>
                                        <li> <a href="{{route('admin.users.create')}}">
                                            Add New
                                            </a> </li>
                                        <li> <a href="{{route('admin.users.edit', Auth::user()->id) }}">
                                            Your Profile
                                            </a> </li>
                                    </ul>
                                </li>


                                <li>
                                    <a href=""> <i class="fa fa-bar-chart"></i> Charts <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="charts-flot.html">
                                            Flot Charts
                                            </a> </li>
                                        <li> <a href="charts-morris.html">
                                            Morris Charts
                                            </a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-table"></i> Tables <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="static-tables.html">
                                            Static Tables
                                            </a> </li>
                                        <li> <a href="responsive-tables.html">
                                            Responsive Tables
                                            </a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="forms.html"> <i class="fa fa-pencil-square-o"></i> Forms </a>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-desktop"></i> UI Elements <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="buttons.html">
                                            Buttons
                                            </a> </li>
                                        <li> <a href="cards.html">
                                            Cards
                                            </a> </li>
                                        <li> <a href="typography.html">
                                            Typography
                                            </a> </li>
                                        <li> <a href="icons.html">
                                            Icons
                                            </a> </li>
                                        <li> <a href="grid.html">
                                            Grid
                                            </a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-file-text-o"></i> Pages <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="login.html">
                                            Login
                                            </a> </li>
                                        <li> <a href="signup.html">
                                            Sign Up
                                            </a> </li>
                                        <li> <a href="reset.html">
                                            Reset
                                            </a> </li>
                                        <li> <a href="error-404.html">
                                            Error 404 App
                                            </a> </li>
                                        <li> <a href="error-404-alt.html">
                                            Error 404 Global
                                            </a> </li>
                                        <li> <a href="error-500.html">
                                            Error 500 App
                                            </a> </li>
                                        <li> <a href="error-500-alt.html">
                                            Error 500 Global
                                            </a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://github.com/modularcode/modular-admin-html"> <i class="fa fa-github-alt"></i> Theme Docs </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="nav metismenu" id="customize-menu">
                            <li>
                                <ul>
                                    <li class="customize">
                                        <div class="customize-item">
                                            <div class="row customize-header">
                                                <div class="col-xs-4"> </div>
                                                <div class="col-xs-4"> <label class="title">fixed</label> </div>
                                                <div class="col-xs-4"> <label class="title">static</label> </div>
                                            </div>
                                            <div class="row hidden-md-down">
                                                <div class="col-xs-4"> <label class="title">Sidebar:</label> </div>
                                                <div class="col-xs-4"> <label>
                                                    <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed" >
                                                    <span></span>
                                                    </label> </div>
                                                <div class="col-xs-4"> <label>
                                                    <input class="radio" type="radio" name="sidebarPosition" value="">
                                                    <span></span>
                                                    </label> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4"> <label class="title">Header:</label> </div>
                                                <div class="col-xs-4"> <label>
                                                    <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                    <span></span>
                                                    </label> </div>
                                                <div class="col-xs-4"> <label>
                                                    <input class="radio" type="radio" name="headerPosition" value="">
                                                    <span></span>
                                                    </label> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4"> <label class="title">Footer:</label> </div>
                                                <div class="col-xs-4"> <label>
                                                    <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                    <span></span>
                                                    </label> </div>
                                                <div class="col-xs-4"> <label>
                                                    <input class="radio" type="radio" name="footerPosition" value="">
                                                    <span></span>
                                                    </label> </div>
                                            </div>
                                        </div>
                                        <div class="customize-item">
                                            <ul class="customize-colors">
                                                <li> <span class="color-item color-red" data-theme="red"></span> </li>
                                                <li> <span class="color-item color-orange" data-theme="orange"></span> </li>
                                                <li> <span class="color-item color-green active" data-theme=""></span> </li>
                                                <li> <span class="color-item color-seagreen" data-theme="seagreen"></span> </li>
                                                <li> <span class="color-item color-blue" data-theme="blue"></span> </li>
                                                <li> <span class="color-item color-purple" data-theme="purple"></span> </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <a href=""> <i class="fa fa-cog"></i> Customize </a>
                            </li>
                        </ul>
                    </footer>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>

                @yield('content')

                <footer class="footer">
                    <div class="footer-block buttons"> <iframe class="footer-github-btn" src="https://ghbtns.com/github-btn.html?user=modularcode&repo=modular-admin-html&type=star&count=true" frameborder="0" scrolling="0" width="140px" height="20px"></iframe> </div>
                    <div class="footer-block author">
                        <ul>
                            <li> created by <a href="https://github.com/modularcode">ModularCode</a> </li>
                            <li> <a href="https://github.com/modularcode/modular-admin-html#get-in-touch">get in touch</a> </li>
                        </ul>
                    </div>
                </footer>
                <div class="modal fade" id="modal-media">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="modal-title">Media Library</h4> </div>
                            <div class="modal-body modal-tab-container">
                                <ul class="nav nav-tabs modal-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a> </li>
                                    <li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
                                </ul>
                                <div class="tab-content modal-tab-content">
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="images-container">
                                            <ul class="row image-row">
                                            @if(isset($photos))
                                              @foreach($photos as $photo)
                                                <li class="col-sm-2" >
                                                    <div class="image-wrapper" photo-id="{{ $photo->id }}">
                                                        <img src="{{ asset($photo->file_path) }}" alt="" class="image-gallary">
                                                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                    </div>
                                                </li>
                                              @endforeach
                                            @endif

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                        <div class="upload-container">
                                            <div id="dropzone">
                                                <form action="{{ url('admin/medias') }}" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                    <div class="dz-message-block">
                                                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                    </div>

                                                    {{ csrf_field() }}

                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" id="insert-selected" data-dismiss="modal">Insert Selected</button> </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal fade" id="confirm-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4> </div>
                            <div class="modal-body">
                                <p>Are you sure want to do this?</p>
                            </div>
                            <div class="modal-footer">
                               @if(isset($user))
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'class' => 'delete-item-form']) !!}
                                        {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}

                                @elseif(isset($post))
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'class' => 'delete-item-form']) !!}
                                        {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}

                                @elseif(isset($category))
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id], 'class' => 'delete-item-form']) !!}
                                        {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}

                                @elseif(isset($tag))
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminTagsController@destroy', $tag->id], 'class' => 'delete-item-form']) !!}
                                        {!! Form::submit('Yes', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                @endif
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="{{asset('js/admin/vendor.js')}}"></script>

        <script src="{{asset('js/admin/dropzone.js')}}"></script>

        @yield('scripts')

        <script src="{{ asset('js/admin/app.js') }}"></script>


    </body>

</html>
