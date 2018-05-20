@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" href="{{asset("assets/css/faq.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/faq.js")}}"></script>
@endpush

    @section('title', 'よくあるご質問')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <h1 class="main__title">
                <picture>
                    <img src="{{asset("assets/img/faq/title.png")}}"
                         srcset="{{asset("assets/img/faq/title@2x.png")}} 2x" alt="よくあるご質問">
                </picture>
            </h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="">HOME</a></li>
                    <li>よくあるご質問</li>
                </ul>
                <div class="faq">
                    <ul class="faq__tabs">
                        <li class="faq__tab is-current"><a href="#faq01">注文方法について</a></li>
                        <li class="faq__tab"><a href="#faq02">幕の仕様について</a></li>
                        <li class="faq__tab"><a href="#faq03">オリジナルのロゴや写真について</a></li>
                        <li class="faq__tab"><a href="#faq04">デザイン制作について</a></li>
                        <li class="faq__tab"><a href="#faq05">発送について</a></li>
                        <li class="faq__tab"><a href="#faq06">耐久性・アフターサポートについて</a></li>
                    </ul>
                    <section id="faq01" class="faq__section">
                        <h2 class="faq__heading">注文方法について</h2>
                        <dl class="faq__list">
                            <dt>やり方がわかりません。遠隔サポートをしてもらえませんか。</dt>
                            <dd>メールまたは電話でお手伝いさせていただきますので、お気軽にご連絡ください。</dd>
                            <dt>
                                やり方がわかりません。使いたいイラストも、コメントも、フォントも決まっています。使いたい写真も用意しました。レイアウトも決めました。手書きでイメージを送ります。デザインしてもらえますか。
                            </dt>
                            <dd>手書き原稿からのデーター制作も承ります。ロゴなどの制作で料金が発生する場合がありますので、まずはご連絡ください。（デザイン費は要検討）</dd>
                            <dt>急に必要になりました。割増料金を払えば、特急で製作してもらえますか。</dt>
                            <dd>・・・要検討（特急翌日発送　20％UP　5枚まで）</dd>
                            <dt>同じものをもう一度作りたい場合、改めてデーターを送らなければいけませんか。</dt>
                            <dd>過去のデーターはマイページに保存されていますので、そちらから再注文可能です。マイページから見つからない場合でも、データーは保管されている場合があるので、ご相談ください。
                            </dd>
                            <dt>追加で製作してもらいたいのですが、データーが見つかりません。どうしたらよいですか。</dt>
                            <dd>過去のデーターはマイページに保存されていますので、そちらから再注文可能です。マイページから見つからない場合でも、データーは保管されている場合があるので、ご相談ください。
                            </dd>
                            <dt>幕を取り付ける棒（竿）やロープも買えますか。</dt>
                            <dd>竿とロープの付属品も取り扱っております。</dd>
                            <dt>どんな支払い方法を選べますか。</dt>
                            <dd>クレジットカード（VISA、MASTER、JCB）およびコンビニ決済がご利用いただけます。2018年4月現在、一部の決済方法は準備中です。</dd>
                        </dl>
                    </section>
                    <!-- /#faq01 -->
                    <section id="faq02" class="faq__section">
                        <h2 class="faq__heading">幕の仕様について</h2>
                        <dl class="faq__list">
                            <dt>表にあるサイズしか作れないのですか。</dt>
                            <dd>完全なオリジナルサイズの幕や、表にあるよりさらに大型の幕についても多くの制作実績があります。メール、電話または問い合わせフォームにてご相談ください。</dd>
                            <dt>表にある生地しか使えないのですか。</dt>
                            <dd>表にある以外にも、用途に応じた約30種類の様々な生地を扱っております。ぴったりの生地をご提案させていただきますので、メールまたは電話にてご相談ください。</dd>
                            <dt>ハトメとは何ですか。</dt>
                            <dd>写真にあるようなロープなどを通すための環状の補強のことです。幕王では見た目を損なわないようプラスチック製のハトメを採用しています。</dd>
                            <dt>ハトメを金属製に変更できますか。</dt>
                            <dd>より強度のある金属製のハトメもオーダー可能です。注文時に備考欄にてお知らせください。</dd>
                            <dt>寸法精度はどのくらいですか。</dt>
                            <dd>寸法精度は±１%です。2mの大きさの幕だと2cm程度の誤差がある場合がございます。</dd>
                        </dl>
                    </section>
                    <!-- /#faq02 -->
                    <section id="faq03" class="faq__section">
                        <h2 class="faq__heading">オリジナルのロゴや写真について</h2>
                        <dl class="faq__list">
                            <dt>付けたい写真は、JPEGです。使えますか。</dt>
                            <dd>JPEG画像のほか、PNG、GIF形式の画像が使えます。</dd>
                            <dt>貼り付けたい画像のファイル形式はJPEG、PNG、GIF、TIFのどれでもよいですか。</dt>
                            <dd>・・・TIFは要確認。</dd>
                            <dt>載せる写真は、どのくらいの解像度が必要ですか。</dt>
                            <dd>・・・要確認</dd>
                            <dt>スマホで撮った写真は使えますか。</dt>
                            <dd>スマートフォンの写真をご利用いただけます。なるべく高画質モードで撮影された写真のほうがよりきれいに仕上がるのでお勧めです。</dd>
                            <dt>用意されたイラストではなくて、自分で描いたイラストは使えますか。その場合、どのようなファイル形式にするのでしょうか。</dt>
                            <dd>オリジナルのイラストもご利用いただけます。JPEG、PNG、GIF形式のいずれかをご利用ください。</dd>
                            <dt>事例写真の中に気に入ったものがあります。学校名だけ変更して、作ってもらえますか。</dt>
                            <dd>学校名などはデザイン例を元に自由に編集して制作可能です。デザイン例からご希望のデザインが見つからない場合は、メールまたは電話にてご相談ください。</dd>
                            <dt>校章や社章は使えますか。</dt>
                            <dd>
                                ご利用者様ご自身で画像をアップロードして、オリジナルのロゴ等をデザインに追加できます。画像データーが無い場合は、写真等からデーターを作成することも出来ます（有料）ので、ご相談ください。
                            </dd>
                            <dt>社名のロゴは使えますか。</dt>
                            <dd>
                                ご利用者様ご自身で画像をアップロードして、オリジナルのロゴ等をデザインに追加できます。画像データーが無い場合は、写真等からデーターを作成することも出来ます（有料）ので、ご相談ください。
                            </dd>
                        </dl>
                    </section>
                    <!-- /#faq03 -->
                    <section id="faq04" class="faq__section">
                        <h2 class="faq__heading">デザイン制作について</h2>
                        <dl class="faq__list">
                            <dt>自分でレイアウトや色を選べるのは魅力ですが、出来上がりを想像できません。製作前にプロの方がチェックして、アドバイスをしてくれるのですか。</dt>
                            <dd>メールまたは電話でお手伝いさせていただきますので、お気軽にご連絡ください。</dd>
                            <dt>金色、銀色も印刷できますか。</dt>
                            <dd>申し訳ありませんが、金色、銀色は印刷できません。かわりに黄色にグラデーション効果を組み合わせせるなどしてメタリック感を表現いたします。</dd>
                            <dt>目の錯覚を利用して、金色、銀色に見せる方法は、ありますか。</dt>
                            <dd>申し訳ありませんが、金色、銀色は印刷できません。かわりに黄色にグラデーション効果を組み合わせせるなどしてメタリック感を表現いたします。</dd>
                            <dt>塗り足しとは何ですか。</dt>
                            <dd>塗り足しとは、仕上がりのサイズよりも外にある、裏面に折り返される部分のことです。仕上げの縫製加工の都合により、塗り足しによって背景を拡大してデーターを作成してください。
                            </dd>
                            <dt>用意されたフォントではなく、手書きの文字を使うことはできますか。</dt>
                            <dd>手書きの文字は画像としてご利用いただけます。（システム対応要検討）</dd>
                            <dt>要されているフォント以外の市販のフォントを使ってもよいですか。</dt>
                            <dd>標準のフォント以外の文字については、画像としてご利用いただけます。（システム対応要検討）</dd>
                            <dt>Word、Excel、PowerPointなどで作成した図や文字を使えますか。</dt>
                            <dd>手書き原稿と同様にWordなどで作成されたデーターをお送りいただければ、こちらにて印刷可能な形式に変換して、幕を制作いたします。</dd>
                            <dt>使わない方がよい色の組み合わせはありますか。（目立たない、きれいでない、品がない、製作時に再現しにくい・・・・・など）</dt>
                            <dd>
                                コンピューター上で使われる色であれば、どのような組み合わせでも再現できます。デザインでのお悩みであれば、経験豊富なデザイナーがお手伝いいたしますので、メールまたは電話にてご相談ください。
                            </dd>
                        </dl>
                    </section>
                    <!-- /#faq04 -->
                    <section id="faq05" class="faq__section">
                        <h2 class="faq__heading">発送について</h2>
                        <dl class="faq__list">
                            <dt>発注者の住所と送り先が違ってもよいですか。</dt>
                            <dd>発注者様と送り先の住所が別でもご利用いただけます。</dd>
                            <dt>発注者と支払者が違ってもよいですか。</dt>
                            <dd>領収書のあて先が編集可能です。（システム対応が必要）</dd>
                            <dt>受け取りの時間指定はできますか。</dt>
                            <dd>システム対応が必要</dd>
                            <dt>ホテルや競技場で使いたいのですが、時間指定で、直接、会場に届けてもらえますか。</dt>
                            <dd>システム対応が必要</dd>
                        </dl>
                    </section>
                    <!-- /#faq05 -->
                    <section id="faq06" class="faq__section">
                        <h2 class="faq__heading">耐久性・アフターサポートについて</h2>
                        <dl class="faq__list">
                            <dt>作ってもらった幕をブログにアップしてもよいですか。</dt>
                            <dd>自由にブログにアップロードしていただいて結構です。</dd>
                            <dt>作ってもらった幕と同じデザインを、パンフレットや案内状に使ってもよいですか。</dt>
                            <dd>幕の写真であれば問題ありません。・・・要検討</dd>
                            <dt>この幕の著作権及び使用権はどこに帰属しますか。</dt>
                            <dd>・・・要検討</dd>
                            <dt>耐久性はどのくらいの期間ですか。</dt>
                            <dd>使用される環境によりますが、屋外で継続して掲示される場合の耐久性は半年程度です。風や日差しの強い場所では痛みが早くなることがあります。</dd>
                            <dt>毎年、同じ時期に使いたいのですが、何年くらい使えますか。</dt>
                            <dd>短時間の使用であれば殆ど劣化することなくご使用いただけます。風が強い場所でのご使用を避け、涼しい場所に保管していただければ、より長くご利用いただけます。</dd>
                            <dt>毎年使いたいのですが、保管方法はどうしたらよいですか。</dt>
                            <dd>高温多湿の場所を避けて保管してください。ビニール生地の幕は折りたたまずに巻いて保管してください。</dd>
                            <dt>汚れたときに、洗濯はできますか。</dt>
                            <dd>ポリエステル生地は中性洗剤で手洗いしてください。ビニール生地は水拭きしてください。</dd>
                            <dt>汚れたときに、ドライクリーニングはできますか。</dt>
                            <dd>ドライクリーニングは出来ません。</dd>
                            <dt>アイロンをかけても大丈夫ですか。</dt>
                            <dd>ポリエステル生地は120度以下の低温でアイロンをかけてください。ビニール生地はアイロン掛けできません。</dd>
                            <dt>スチームでしわ伸ばしをしても大丈夫ですか。</dt>
                            <dd>スチームによる高温は色あせの原因となる場合があるので避けてください。</dd>
                            <dt>何回も使っていたら、縫製がほつれてきました。幕はきれいです。縫製だけやり直してもれますか。</dt>
                            <dd>状態がよければ縫製によって修復できる場合があります。メールまたは電話にてご相談ください。</dd>
                        </dl>
                    </section>
                    <!-- /#faq06 -->
                    <a class="faq__btn" href=""><img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a>
                </div>
            </div>
        </div>
    </main>
    <!-- /.l-main -->
@endsection