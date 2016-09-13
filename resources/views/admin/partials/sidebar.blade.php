<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> Express News </div>
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
                    <a href="{{ route('admin.comments.index') }}"> <i class="fa fa-comments-o" aria-hidden="true"></i> Comments <i class="fa arrow"></i></a>
                    <ul>
                        <li> <a href="{{route('admin.comments.index')}}">
                            All Comments
                            </a> </li>
                        <li> <a href="{{route('admin.comment.replies.index')}}">
                            Replies
                            </a> </li>
                    </ul>
                </li>

                <li>
                    <a href=""> <i class="fa fa-camera" aria-hidden="true"></i> Media <i class="fa arrow"></i> </a>
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
