<!DOCTYPE html>
<html lang="ja">
    <head>
        @include('admin.components.head')
        @include('admin.components.css')
        @yield('page-css')
    </head>
    <body class="hold-transition login-page">
        <div id="app" class="login-box">
            @yield('content')
        </div>

        @include('admin.components.js')
        @yield('page-js')
    </body>
</html>
