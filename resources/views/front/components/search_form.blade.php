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
                <ul class="search__option--radio cf">
                @foreach ($ratios as $index => $ratio)
                        <li>
                            <input type="radio" name="ratio" id="ratio_{{$index}}" value="{{ $ratio->id }}" {{ (isset($search['ratio']) ? $search['ratio'] : $index)==$ratio->id ? "checked":"" }}>
                            <label for="ratio_{{$index}}">{{ $ratio->height }}:{{ $ratio->width }}</label>
                        </li>
                    @endforeach
                </ul>
                <h3 class="search__item">スポーツを選ぶ</h3>
                <ul class="search__option--checkbox">
                    @foreach ($category_1 as $index => $category)
                        <li>
                            <input type="checkbox" name="category_1[]" id="category_1_{{ $index }}" value="{{ $category->id }}"
                                    {{ isset($search['category_1']) ? in_array($category->id, $search['category_1']) : false ? "checked":"" }}>
                            <label for="category_1_{{ $index }}">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
                <h3 class="search__item">テイストを選ぶ</h3>
                <ul class="search__option--checkbox">
                    @foreach ($category_2 as $index => $category)
                        <li>
                            <input type="checkbox" name="category_2[]" id="category_2_{{ $index }}" value="{{ $category->id }}"
                                    {{ isset($search['category_2']) ? in_array($category->id, $search['category_2']) : false ? "checked":"" }}>
                            <label for="category_2_{{ $index }}">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
                <h3 class="search__item">シーンを選ぶ</h3>
                <ul class="search__option--checkbox">
                    @foreach ($category_3 as $index => $category)
                        <li>
                            <input type="checkbox" name="category_3[]" id="category_3_{{ $index }}" value="{{ $category->id }}"
                                    {{ isset($search['category_3']) ? in_array($category->id, $search['category_3']) : false ? "checked":"" }}>
                            <label for="category_3_{{ $index }}">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
                <input type="submit" value="検索">
            </form>
        </div>
    </div>
</section>