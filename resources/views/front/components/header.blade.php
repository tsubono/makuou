<header class="l-header">
    <div class="wrap cf">
        <div class="left">
            <div class="cf">
                <h1 class="logo">
                    <a href="/">
                        <img src="{{asset("assets/img/common/logo.png")}}" alt="幕王"></a></h1>
                <ul class="head__nav">
                    <li><a href="{{url('/search')}}">デザインを探す</a></li>
                    <li><a href="{{url('/size')}}">サイズの選び方</a></li>
                    <li><a href="{{url('/example')}}">実績を見る</a></li>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="{{url('/mypage')}}">マイページ</a></li>
                    @else
                        <li><a href="{{url('/register')}}">会員登録</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="right sp_none">
            <div class="hour">
                <div><img src="{{asset("assets/img/common/header_tel.png")}}" alt="0120-805-266"></div>
                <p class="time">営業時間　9:00～17:00　土日祝休み</p>
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
            <li><a href="{{url('/guide')}}">ご注文の流れ</a></li>
            <li><a href="{{url('/price')}}">価格表</a></li>
            <li><a href="{{url('/example')}}">事例紹介</a></li>
            <li><a href="{{url('/faq')}}">よくあるご質問</a></li>
            <li><a href="{{url('/contact')}}">お問い合わせ</a></li>
        </ul>
    </nav>
</header>
<div class="sp-nav">
    <div class="hour">
        <div><a href="tel:0120805266"><img src="{{asset("assets/img/common/header_tel.png")}}" alt="0120-805-266"></a></div>
        <p class="time">営業時間　9:00～17:00　土日祝休み</p>
    </div>
    <ul class="head__nav">
        <li><a href="{{url('/search')}}">デザインを探す</a></li>
        <li><a href="{{url('/size')}}">サイズの選び方</a></li>
        <li><a href="{{url('/example')}}">実績を見る</a></li>
        <li><a href="{{url('/register')}}">会員登録</a></li>
    </ul>
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
</div>


<aside>
    <div class="sidebtn"><img src="{{asset("assets/img/common/arrow_l_white.gif")}}"></div>
    <div class="sidenav">
        <div class="sidenav__link">
            <a href="{{ url('/result?') }}">デザインを見る</a>
        </div>
        <div class="sidenav__list">
            <dl>
                <dt><a href="{{url('/guide')}}">ご利用ガイド</a></dt>
            </dl>
            <dl>
                <dt><a href="{{url('/price')}}">料金表を見る</a></dt>
            </dl>
            <dl>
                <dt><a href="#">スポーツから選ぶ</a></dt>
                <dd><a href="{{url('/result')}}?category_1[]=4">サッカー</a></dd>
                <dd><a href="{{url('/result')}}?category_1[]=5">野球</a></dd>
                <dd><a href="{{url('/result')}}?category_1[]=6">バスケ</a></dd>
                <dd><a href="{{url('/search')}}">他を見る</a></dd>
            </dl>
            <dl>
                <dt><a href="#">テイストから選ぶ</a></dt>
                <dd><a href="{{url('/result')}}?category_2[]=24">シンプル</a></dd>
                <dd><a href="{{url('/result')}}?category_2[]=25">熱血</a></dd>
                <dd><a href="{{url('/result')}}?category_2[]=26">スポーティ</a></dd>
                <dd><a href="{{url('/search')}}">他を見る</a></dd>
            </dl>
        </div>
        <div class="sidenav__link2"><a href="{{url('/mypage')}}">マイページを見る</a></div>
        <div class="sidenav__link2">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{url('/logout')}}">ログアウト</a>
            @else
                <a href="{{url('/login')}}">ログイン</a>
            @endif
        </div>
    </div>
</aside>