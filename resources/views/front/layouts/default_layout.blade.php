<!doctype html>
<html>
<head>
    @include('front.components.head')
    @include('front.components.css_layout')
</head>
<body>

<header>
    <div class="logo">
        <a href="/">
            <img src="{{ asset('assets/img/layout/logo.png') }}" alt="幕王"></a>
    </div>
</header>

@yield('content')

@include('front.components.js')
</body>
</html>