@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'お気に入りテンプレート')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="favorite">

                <h1 class="main__title"><img src="{{asset("assets/img/favorite/title.png")}}" alt="お気に入りテンプレート"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li><a href="{{ url('/mypage') }}">マイページ</a></li>
                        <li>お気に入りテンプレート</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h4 class="ttl01 mt25">お気に入りテンプレート</h4>

                            <div class="result">
                                @foreach($products as $product)
                                    <div class="result__box">
                                        <div>
                                            <h2 class="result__title">{{$product['title']}}</h2>
                                            <a href="{{url('/layout/' . $product['id'])}}">
                                                <img class="result__img" src="{{asset($product['image'])}}" alt="">
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
                                        <div class="result__fav del">
                                            <a href="{{url('/deleteFavorite?productId=' . $product['id'])}}">
                                                <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                     alt="">お気に入りから削除する
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--/.main_blockr -->
                        <div class="main__block_l">
                            @include('front.components.mypageside')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- /.l-main -->
@endsection