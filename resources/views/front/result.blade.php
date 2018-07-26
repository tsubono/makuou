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
                    <img src="{{asset("assets/img/search/result/title.png")}}"
                         srcset="{{asset("assets/img/search/result/title@2x.png")}} 2x" alt="横断幕を作る">
                </picture>
            </h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="{{url('/')}}">HOME</a></li>
                    <li><a href="{{url('/search')}}">横断幕を作る</a></li>
                    <li>検索結果</li>
                </ul>
                <div class="result">
                    @foreach($products as $product)
                        <div class="result__box">
                            <div>
                                <h2 class="result__title">{{ $product->title }}</h2>
                                <a href="{{ url('layout/'. $product->id) }}">
                                    <img class="result__img" src="{!! asset(env('PUBLIC', ''). $product->image) !!}"
                                         alt="{{ $product->title }}">
                                </a>

                                @if(isset($product['category_1']))
                                    <dl class="result__list">
                                        <dt>スポーツ</dt>
                                        <dd>
                                            <ul class="result__tags">
                                                @foreach ($product->getCategories($product->category_1) as $category)
                                                    <li>
                                                        <a href="{{ url('result') }}?category_1[]={{ $category->id }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </dl>
                                @endif
                                @if(isset($product['category_2']))
                                    <dl class="result__list">
                                        <dt>テイスト</dt>
                                        <dd>
                                            <ul class="result__tags">
                                                @foreach ($product->getCategories($product->category_2) as $category)
                                                    <li>
                                                        <a href="{{ url('result') }}?category_2[]={{ $category->id }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </dl>
                                @endif
                                @if(isset($product['category_3']))
                                    <dl class="result__list">
                                        <dt>シーン</dt>
                                        <dd>
                                            <ul class="result__tags">
                                                @foreach ($product->getCategories($product->category_3) as $category)
                                                    <li>
                                                        <a href="{{ url('result') }}?category_3[]={{ $category->id }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </dl>
                                @endif
                            </div>
                            <div class="result__fav">
                                @if($favorites[$loop->index])
                                    <a href="/cancelFavorite?productId={{$product->id}}&@foreach($search as $key => $param){{$key}}=@if(is_array($param))@foreach($param as $data){{$data . ','}}@endforeach&@else{{$param}}&@endif @endforeach">
                                        <img src="{{asset("assets/img/common/ico_fav.png")}}" alt="">
                                        お気に入りに登録済み
                                    </a>
                                @else($favorites[$loop->index])
                                    <a href="/addFavorite?productId={{$product->id}}&@foreach($search as $key => $param){{$key}}=@if(is_array($param))@foreach($param as $data){{$data . ','}}@endforeach&@else{{$param}}&@endif @endforeach">
                                        <img src="{{asset("assets/img/common/ico_fav.png")}}" alt="">
                                        お気に入りに登録する
                                    </a>
                                @endif
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