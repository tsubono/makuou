@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
@endpush

@section('title', '検索結果')

@section('content')
<main class="l-main">
    <div class="l-inner">
        <h1 class="main__title">
            <picture>
                <img src="{{asset("assets/img/search/result/title.png")}}" srcset="{{asset("assets/img/search/result/title@2x.png")}} 2x" alt="横断幕を作る">
            </picture>
        </h1>
        <div class="main__content">
            <ul class="main__breadcrumb">
                <li><a href="{{url('/')}}">HOME</a></li>
                <li><a href="{{url('search')}}">横断幕を作る</a></li>
                <li>検索結果</li>
            </ul>
            <div class="result">
                @foreach($products as $product)
                    <div class="result__box">

                        <div>
                            <h2 class="result__title">{{ $product->title }}</h2>
                            <img class="result__img" src="{!! asset(env('PUBLIC', ''). $product->image) !!}" alt="{{ $product->title }}">

                            <dl class="result__list">
                                <dt>スポーツ</dt>
                                <dd>
                                    <ul class="result__tags">
                                        @foreach ($product->getCategories($product->category_1) as $category)
                                            <li><a href="">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="result__list">
                                <dt>テイスト</dt>
                                <dd>
                                    <ul class="result__tags">
                                        @foreach ($product->getCategories($product->category_2) as $category)
                                            <li><a href="">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="result__list">
                                <dt>シーン</dt>
                                <dd>
                                    <ul class="result__tags">
                                        @foreach ($product->getCategories($product->category_3) as $category)
                                            <li><a href="">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                    </div>
                @endforeach
                <!-- .result__box -->
            </div>
            @include('front.components.search_form', compact('category_1', 'category_2', 'category_3', 'ratios', 'search'))
        </div>
    </div>
</main>
<!-- /.l-main -->
@endsection