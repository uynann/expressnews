<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/images/favicons/manifest.json">
        <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="{{asset('css/admin/vendor.css')}}">

        <link rel="stylesheet" href="{{asset('css/admin/app-default.css')}}">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.css">



        <!-- Theme initialization -->
        <script>
var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
{};
var themeName = themeSettings.themeName || '';


if (themeName)
{
    document.write('<link rel="stylesheet" id="theme-style" href="http://localhost:8888/css/app-' + themeName + '.css">');

}
else
{
    document.write('<link rel="stylesheet" id="theme-style" href="http://localhost:8888/css/app-default.css">');
}
        </script>

        @yield('styles')

        <link rel="stylesheet" href="{{asset('css/admin/styles.css')}}">
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                @include('admin.partials.header')
                @include('admin.partials.sidebar')


                @yield('content')


                @include('admin.partials.footer')

                @include('admin.partials.modal-media')
                @include('admin.partials.confirm-modal')
                @include('admin.partials.confirm-bulk-delete')

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

        <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
        </script>


        <script src="{{ asset('js/admin/dropzone.js')}}"></script>
        <script src="{{ asset('js/admin/dropzone-options.js') }}"></script>

        <script src="{{asset('js/admin/vendor.js')}}"></script>

        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.js"></script>

        @yield('scripts')

        <script src="{{ asset('js/admin/app.js') }}"></script>

    </body>
</html>
