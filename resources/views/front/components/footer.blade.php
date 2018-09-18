{{--<div class="fix__mypage">--}}
    {{--<a href="{{ url('/mypage') }}">--}}
        {{--<img src="{{asset("assets/img/common/ico_mypage.png")}}" alt="">マイページ--}}
    {{--</a>--}}
{{--</div>--}}
<footer class="l-footer">
    <ul class="wrap cf">
        <li class="logo">
            <div><img src="{{asset("assets/img/common/makuou.png")}}" alt="幕王"></div>
            <div class="btn red"><a href="{{ url('/search') }}">オリジナル横断幕を作る</a></div>
            <div class="btn org"><a href="{{ url('/sample') }}">サンプルのご請求はこちら</a></div>
            <div class="btn org"><a href="{{ url('/login') }}">会員ログイン</a></div>
        </li>
        <li>
            <dl>
                <dt>初めての方へ</dt>
                <dd><a href="{{url('/concept')}}">幕王について</a></dd>
                <dd><a href="{{url('/register')}}">会員登録</a></dd>
                <dd><a href="{{url('/')}}">ギャラリー（事例紹介）</a></dd>
            </dl>
            <dl>
                <dt>ご利用ガイド</dt>
                <dd><a href="{{url('/guide')}}#ank-01">ご注文の流れ</a></dd>
                <dd><a href="{{url('/guide')}}#ank-02">納期・お届けについて</a></dd>
                <dd><a href="{{url('/guide')}}#ank-03">お支払い方法</a></dd>
                <dd><a href="{{url('/guide')}}#ank-04">発送方法・送料</a></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>よくあるご質問</dt>
                <dd><a href="{{url('/faq')}}">注文方法について</a></dd>
                <dd><a href="{{url('/faq')}}">幕の仕様について</a></dd>
                <dd><a href="{{url('/faq')}}">オリジナルのロゴや写真について</a></dd>
                <dd><a href="{{url('/faq')}}">デザイン制作について</a></dd>
                <dd><a href="{{url('/faq')}}">発送について</a></dd>
                <dd><a href="{{url('/faq')}}">耐久性・アフターサポートについて</a></dd>
            </dl>
            <dl>
                <dt>ご案内</dt>
                <dd><a href="{{url('/price')}}">価格表</a></dd>
                <dd><a href="{{ url('/material') }}">素材について</a></dd>
                <dd><a href="{{ url('/size') }}">サイズについて</a></dd>
                <dd><a href="{{ url('/option') }}">オプションについて</a></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>運営会社概要</dt>
                <dd><a href="{{ url('/company') }}">運営会社概要</a></dd>
                <dd><a href="{{ url('/contract') }}">ご利用規約</a></dd>
                <dd><a href="{{ url('/privacy') }}">プライバシーポリシー</a></dd>
                <dd><a href="{{ url('/transactions') }}">特定取引法に基づく表示</a></dd>
                <dd><a href="{{ url('/contact') }}">お問い合わせ</a></dd>
            </dl>
        </li>
    </ul>
    <address>copyright &copy; Osakabisou All rights reserved.</address>
</footer>
