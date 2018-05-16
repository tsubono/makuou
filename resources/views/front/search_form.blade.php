<section class="search">
    <div class="search__inner">
        <h2 class="search__heading">
            <picture>
                <img src="{{asset("assets/img/search/heading--search.png")}}" srcset="{{asset("assets/img/search/heading--search@2x.png")}} 2x" alt="テンプレートを探す">
            </picture>
        </h2>
        <div class="search__form">
            <form method="get" action="{{url('result')}}">
                <h3 class="search__item">縦横比率を選択する</h3>
                <ul class="search__option--radio">
                    <li><input type="radio" name="aspect" id="aspect01" checked><label for="aspect01">1:1</label></li>
                    <li><input type="radio" name="aspect" id="aspect02"><label for="aspect02">1:1.5</label></li>
                    <li><input type="radio" name="aspect" id="aspect03"><label for="aspect03">1:2</label></li>
                    <li><input type="radio" name="aspect" id="aspect04"><label for="aspect04">1:3</label></li>
                    <li><input type="radio" name="aspect" id="aspect05"><label for="aspect05">1:4</label></li>
                </ul>
                <h3 class="search__item">スポーツを選ぶ</h3>
                <ul class="search__option--checkbox">
                    <li><input type="checkbox" name="sports" id="sports01"><label for="sports01">1.サッカー・フットサル</label></li>
                    <li><input type="checkbox" name="sports" id="sports02"><label for="sports02">2.野球・ソフトボール</label></li>
                    <li><input type="checkbox" name="sports" id="sports03"><label for="sports03">3.バスケットボール</label></li>
                    <li><input type="checkbox" name="sports" id="sports04"><label for="sports04">4.バレーボール</label></li>
                    <li><input type="checkbox" name="sports" id="sports05"><label for="sports05">5.テニス</label></li>
                    <li><input type="checkbox" name="sports" id="sports06"><label for="sports06">6.バトミントン</label></li>
                    <li><input type="checkbox" name="sports" id="sports07"><label for="sports07">7.ラグビー</label></li>
                    <li><input type="checkbox" name="sports" id="sports08"><label for="sports08">8.ハンドボール</label></li>
                    <li><input type="checkbox" name="sports" id="sports09"><label for="sports09">9.ドッジボール</label></li>
                    <li><input type="checkbox" name="sports" id="sports10"><label for="sports10">10.卓球</label></li>
                    <li><input type="checkbox" name="sports" id="sports11"><label for="sports11">11.剣道</label></li>
                    <li><input type="checkbox" name="sports" id="sports12"><label for="sports12">12.弓道</label></li>
                    <li><input type="checkbox" name="sports" id="sports13"><label for="sports13">13.空手道・柔道</label></li>
                    <li><input type="checkbox" name="sports" id="sports14"><label for="sports14">14.陸上競技</label></li>
                    <li><input type="checkbox" name="sports" id="sports15"><label for="sports15">15.水泳</label></li>
                    <li><input type="checkbox" name="sports" id="sports16"><label for="sports16">16.体操</label></li>
                    <li><input type="checkbox" name="sports" id="sports17"><label for="sports17">17.スキー・スノーボード</label></li>
                    <li><input type="checkbox" name="sports" id="sports18"><label for="sports18">18.スケート</label></li>
                    <li><input type="checkbox" name="sports" id="sports19"><label for="sports19">19.レスリング</label></li>
                    <li><input type="checkbox" name="sports" id="sports20"><label for="sports20">20.ダンス</label></li>
                </ul>
                <h3 class="search__item">テイストを選ぶ</h3>
                <ul class="search__option--checkbox">
                    <li><input type="checkbox" name="taste" id="taste01"><label for="taste01">1.シンプル</label></li>
                    <li><input type="checkbox" name="taste" id="taste02"><label for="taste02">2.熱血</label></li>
                    <li><input type="checkbox" name="taste" id="taste03"><label for="taste03">3.スポーティ</label></li>
                    <li><input type="checkbox" name="taste" id="taste04"><label for="taste04">4.ナチュラル</label></li>
                    <li><input type="checkbox" name="taste" id="taste05"><label for="taste05">5.インパクト</label></li>
                    <li><input type="checkbox" name="taste" id="taste06"><label for="taste06">6.かわいい</label></li>
                    <li><input type="checkbox" name="taste" id="taste07"><label for="taste07">7.ヴィンテージ</label></li>
                    <li><input type="checkbox" name="taste" id="taste08"><label for="taste08">8.ゴージャス</label></li>
                    <li><input type="checkbox" name="taste" id="taste09"><label for="taste09">9.和風</label></li>
                </ul>
                <h3 class="search__item">シーンを選ぶ</h3>
                <ul class="search__option--checkbox">
                    <li><input type="checkbox" name="scene" id="scene01"><label for="scene01">1.スポーツ応援</label></li>
                    <li><input type="checkbox" name="scene" id="scene02"><label for="scene02">2.お祝い・式典</label></li>
                    <li><input type="checkbox" name="scene" id="scene03"><label for="scene03">3.学校行事</label></li>
                    <li><input type="checkbox" name="scene" id="scene04"><label for="scene04">4.イベント・フェス</label></li>
                    <li><input type="checkbox" name="scene" id="scene05"><label for="scene05">5.ホームパーティ</label></li>
                    <li><input type="checkbox" name="scene" id="scene06"><label for="scene06">6.商売繁盛</label></li>
                </ul>
                <input type="submit" value="検索">
            </form>
        </div>
    </div>
</section>