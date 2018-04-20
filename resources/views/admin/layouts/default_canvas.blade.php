<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('admin.components.head')
    @include('admin.components.css')
</head>

<body class="hold-transition skin-black-light sidebar-mini">

<!-- wrapper -->
<div id="app" class="wrapper">

    <!-- header -->
    <header class="main-header">
        @include('admin.components.header')
    </header>
    <!-- end header -->

    <!-- sidebar -->
    <aside class="main-sidebar">
        @include('admin.components.sidebar')
    </aside>
    <!-- end sidebar -->

    <!-- content -->
    <div class="content-wrapper">
        <section class="content-header">
            @yield('content-header')
        </section>
        <section class="content">
            @include('admin.components.message')
            @yield('content')
        </section>
    </div>
    <!-- end content -->

    <!-- footer -->
    <footer class="main-footer">
        @include('admin.components.footer')
    </footer>
    <!-- end footer -->

</div>
<!-- end wrapper -->

<!-- Scripts -->
@include('admin.components.js_canvas')
<!-- end Scripts -->

</body>
</html>
