<!doctype html>
<html>
<head>
    @include('front.components.head')
    @include('front.components.css')
</head>
<body>

@include('front.components.header')

<div class="bg">
    @yield('content')
</div>

@include('front.components.footer')
@include('front.components.js')

</body>
</html>