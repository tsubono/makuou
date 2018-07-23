<div class="fix__mypage">
    <a href="{{ url('/mypage') }}">
        <img src="{{asset("assets/img/common/ico_mypage.png")}}" alt="">マイページ
    </a>
</div>
<footer class="l-footer">
    <ul class="wrap cf">
        <li class="logo">
            <div><img src="{{asset("assets/img/common/makuou.png")}}" alt="幕王"></div>
            <div class="btn red"><a href="{{url('/search')}}">オリジナル横断幕を作る</a></div>
            <div class="btn org"><a href="{{url('')}}">仕様以外の注文について</a></div>
            <div class="btn org"><a href="{{url('/sample')}}">サンプルのご請求はこちら</a></div>
        </li>
        <li>
            <dl>
                <dt>初めての方へ</dt>
                <dd><a href="{{url('/concept')}}">幕王について</a></dd>
                <dd><a href="{{url('')}}">会員制システムについて</a></dd>
            </dl>
            <dl>
                <dt>ご利用案内</dt>
                <dd><a href="{{url('/price')}}">価格表</a></dd>
                <dd><a href="{{url('/guide')}}">ご注文の流れ</a></dd>
                <dd><a href="{{url('')}}">納期・お届けについて</a></dd>
                <dd><a href="{{url('')}}">お支払い方法</a></dd>
                <dd><a href="{{url('')}}">発送方法・送料</a></dd>
                <dd><a href="{{url('/faq')}}">よくあるご質問</a></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>ご注文について</dt>
                <dd><a href="{{url('')}}">デザインレイアウト調整手順</a></dd>
                <dd><a href="{{url('')}}">追加注文について</a></dd>
                <dd><a href="{{url('')}}">キャンセル・交換・返品について</a></dd>
                <dd><a href="{{url('')}}">データ入稿について</a></dd>
            </dl>
            <dl>
                <dt>おすすめTips</dt>
                <dd><a href="{{url('')}}">素材について</a></dd>
                <dd><a href="{{url('/search')}}">サイズについて</a></dd>
                <dd><a href="{{url('/example')}}">お客様の事例紹介</a></dd>
                <dd><a href="{{url('/sample')}}">サンプル請求</a></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>運営会社概要</dt>
                <dd><a href="{{url('/company')}}">運営会社概要</a></dd>
                <dd><a href="{{url('/contract')}}">ご利用規約</a></dd>
                <dd><a href="{{url('/example')}}">お客様の事例紹介</a></dd>
                <dd><a href="{{url('/privacy')}}">プライバシーポリシー</a></dd>
                <dd><a href="{{url('/order')}}">特定取引法に基づく表示</a></dd>
                <dd><a href="{{url('/contact')}}">お問い合わせ</a></dd>
                <dd><a href="{{url('')}}">サイトマップ</a></dd>
            </dl>
            <div><a href="{{url('')}}" target="_blank"><img src="{{asset("assets/img/common/bnr_inkjethouse.png")}}" alt="インクジェットハウス"></a></div>
            <div><a href="{{url('')}}" target="_blank"><img src="{{asset("assets/img/common/bnr_signhouse.png")}}" alt="サインハウス"></a></div>
        </li>
    </ul>
    <address>copyright &copy; Osakabisou All rights reserved.</address>
</footer>