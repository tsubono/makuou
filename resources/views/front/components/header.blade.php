<header class="l-header">
    <div class="wrap cf">
        <div class="left">
            <div class="cf">
                <h1 class="logo"><a href="/"><img src="{{asset("assets/img/common/logo.png")}}" alt="幕王"></a></h1>
                <div class="catch"><img src="{{asset("assets/img/common/head_catch.png")}}" alt="オリジナルの横断幕自分でデザイン気軽に発注">
                </div>
            </div>
        </div>
        <div class="right sp_none">
            <div class="login cf">
                    <p class="name">
                        @if(\Illuminate\Support\Facades\Auth::check())
                        ようこそ{{\Illuminate\Support\Facades\Auth::user()->name}} 様
                        @endif
                    </p>
                <p class="btn">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="{{url('/logout')}}">ログアウト</a>
                    @else
                        <a href="{{url('/login')}}">ログイン</a>
                    @endif
                </p>
            </div>
            <div class="hour">
                <div><img src="{{asset("assets/img/common/tel.png")}}" alt="0120-805-266"></div>
                <div class="box_dot"><p>【営業時間】9:00～17:00　<span class="txt_blue">土</span><span class="txt_red">日祝</span>休み
                    </p></div>
            </div>
        </div>
        <div class="right pc_none sp-ham">
            <a class="menu-trigger">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
    <nav class="sp_none">
        <ul class="cf">
            <li><a href="/">HOME</a></li>
            <li><a href="{{url('/search')}}">横断幕を作る</a></li>
            <li><a href="{{url('/search')}}">テンプレートを検索</a></li>
            <li><a href="{{url('/guide')}}">ご注文の流れ</a></li>
            <li><a href="{{url('/price')}}">価格表</a></li>
            <li><a href="{{url('/example')}}">事例紹介</a></li>
            <li><a href="{{url('/faq')}}">よくあるご質問</a></li>
            <li><a href="{{url('/contact')}}">お問い合わせ</a></li>
        </ul>
    </nav>
</header>
<div class="sp-nav">
    <div class="login cf">
        <p class="name">
            @if(\Illuminate\Support\Facades\Auth::check())
            ようこそ{{\Illuminate\Support\Facades\Auth::user()->name}} 様
            @endif
        </p>
        <p class="btn">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{url('/logout')}}">ログアウト</a>
            @else
                <a href="{{url('/login')}}">ログイン</a>
            @endif
        </p>
    </div>
    <div class="hour">
        <div><a href="tel:0120805266"><img src="{{asset("assets/img/common/tel.png")}}" alt="0120-805-266"></a></div>
        <div class="box_dot"><p>【営業時間】9:00～17:00　<span class="txt_blue">土</span><span class="txt_red">日祝</span>休み</p>
        </div>
    </div>
    <ul class="cf">
        <li><a href="{{url('/')}}">HOME</a></li>
        <li><a href="{{url('/search')}}">横断幕を作る</a></li>
        <li><a href="{{url('/search')}}">テンプレートを検索</a></li>
        <li><a href="{{url('/guide')}}">ご注文の流れ</a></li>
        <li><a href="{{url('/price')}}">価格表</a></li>
        <li><a href="{{url('/example')}}">事例紹介</a></li>
        <li><a href="{{url('/faq')}}">よくあるご質問</a></li>
        <li><a href="{{url('/contact')}}">お問い合わせ</a></li>
    </ul>
</div>