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

        @yield('styles')

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
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <div class="logo">
                                <span class="l l1"></span>
                                <span class="l l2"></span>
                                <span class="l l3"></span>
                                <span class="l l4"></span>
                                <span class="l l5"></span>
                            </div>        ExpressNews Admin
                        </h1> </header>
                    <div class="auth-content">
                        <p class="text-xs-center">LOGIN TO CONTINUE</p>


                        <form id="login-form" method="POST" action="{{ url('/login') }}" novalidate="">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control underlined" name="email" placeholder="Your email address" required>
                            </div>

                            <div class="form-group">
                                <label for="password" >Password</label>
                                <input id="password" type="password" class="form-control underlined" name="password" placeholder="Your password" required>
                            </div>

                            <div class="form-group">

                                <label for="remember">
                                    <input type="checkbox" name="remember" class="checkbox" id="remember">
                                    <span>Remember Me</span>
                                </label>
                                <a href="{{ url('/password/reset') }}" class="forgot-btn pull-right">Forgot password?</a>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div>
                        </form>


                    </div>
                </div>
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
