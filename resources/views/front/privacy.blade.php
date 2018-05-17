@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'プライバシーポリシー')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="privacy">
                <h1 class="main__title"><img src="{{asset("assets/img/privacy/title.png")}}" alt="プライバシーポリシー"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>プライバシーポリシー</li>
                    </ul>
                    <h4 class="ttl01">プライバシーポリシー</h4>
                    <ul class="list_dot mt30">
                        <p class="txt">
                            株式会社大阪美装（以下、当社という）は、個人情報保護の重要性を十分認識して、個人情報の保護に関する法律に則り、適正な対策を講じております。<br>
                            当社は、本ウェブサイト上で提供するサービスにおけるプライバシー情報の取扱いについて、以下のとおりプライバシーポリシーを定めます。</p>
                        <li>個人情報の範囲</li>
                        <p class="txt">
                            当社は、生存する個人を特定識別できる情報を個人情報として捉えています。つまり、住所、氏名、電話番号、性別、生年月日、メールアドレスなど、個人を識別できる情報およびそれと関連付けられた購入記録などのデータを個人情報とします。
                        </p>
                        <li>個人情報の収集方法</li>
                        <p class="txt">
                            当社は、利用登録をいただく際に氏名、生年月日、住所、電話番号、メールアドレスなどの個人情報をお尋ねすることがあります。また、本人以外から個人情報を入手する場合は、個人情報の保護に関する法律を遵守している適法な事業者からの購入など、適正な手段で個人情報を入手するものとします。
                        </p>
                        <li>個人情報の利用目的</li>
                        <p class="txt">
                            当社が保有する個人情報について<br>
                            登録情報の閲覧や修正、利用状況の閲覧を行っていただくため。<br>
                            各商品やサービスのご案内のため。<br>
                            マーケティング（アンケートのお願い等）活動、顧客動向分析、調査分析などのため。<br>
                            ご購入商品の送付・配達・商品代金の回収、その他当社から情報提供通知のため。<br>
                            お問い合わせ又は依頼等への対応のため。<br>
                            その他、事前にお知らせし、同意いただいた目的のため。<br>
                            上記の利用目的に付随する事項のため。
                        </p>
                        <li>個人情報の第三者提供</li>
                        <p class="txt">
                            当社が保有する個人情報は、下記の場合を除いては、あらかじめお客様の同意を得ることなく、第三者に開示又は提供いたしません。
                        </p>
                        <li>法令に基づく場合</li>
                        <p class="txt">
                            人の生命、身体または財産の保護のために必要がある場合であって、本人の同意を得ることが困難であるとき<br>
                            公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって、本人の同意を得ることが困難であるとき<br>
                            国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき
                        </p>
                        <li>開示・訂正・利用停止等の手続きについて</li>
                        <p class="txt">
                            1.当社は、本人から個人情報の開示を求められたときは、本人に対し、遅滞なくこれを開示します。ただし、開示することにより次のいずれかに該当する場合は、その全部または一部を開示しないこともあり、開示しない決定をした場合には、その旨を遅滞なく通知します。<br>

                            &emsp;&emsp;本人または第三者の生命、身体、財産その他の権利利益を害するおそれがある場合<br>
                            &emsp;&emsp;当社の業務の適正な実施に著しい支障を及ぼすおそれがある場合<br>
                            &emsp;&emsp;その他法令に違反することとなる場合<br>

                            2.当社の保有する個人情報が誤った情報であり、当社が定める手続きにより、本人からの請求を受けた場合、当該個人情報の訂正または削除を行います。<br>

                            3.当社は、本人から、個人情報が利用目的の範囲を超えて取り扱われているという理由、または不正の手段により取得されたものであるという理由により、その利用の停止または消去（以下、「利用停止等」といいます。）を求められた場合には、必要な調査を行い、その結果に基づき個人情報の利用停止等を行います。ただし、個人情報の利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって、本人の権利利益を保護するために必要なこれに代わるべき措置をとれる場合は、この代替策を講じます。

                        </p>
                        <li>個人情報に関する受付</li>
                        <p class="txt">
                            本ポリシーに関するお問い合わせは、下記の窓口までお願い致します。<br>
                            株式会社 大阪美装<br>
                            〒566-0035 大阪府摂津市鶴野2-3-19<br>
                            電話：0120-805-266<br>
                            E-mail：info@maku-ou.com
                        </p>
                    </ul>
                </div>
            </section>
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}" alt=""></h2>
                <div class="pickup__content">
                    <div class="pickup__box">
                        <div>
                            <img src="{{asset("assets/img/banner/banner01.png")}}" alt="">
                            <dl class="pickup__info">
                                <dt>比率</dt>
                                <dd>1:1.5</dd>
                                <dt>サイズ</dt>
                                <dd>600</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="pickup__box">
                        <div>
                            <img src="{{asset("assets/img/banner/banner01.png")}}" alt="">
                            <dl class="pickup__info">
                                <dt>比率</dt>
                                <dd>1:1.5</dd>
                                <dt>サイズ</dt>
                                <dd>600</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="pickup__box">
                        <div>
                            <img src="{{asset("assets/img/banner/banner01.png")}}" alt="">
                            <dl class="pickup__info">
                                <dt>比率</dt>
                                <dd>1:1.5</dd>
                                <dt>サイズ</dt>
                                <dd>600</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="btn"><a href="#"><img src="{{asset("assets/img/top/make_btn.png")}}"
                                                  alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection