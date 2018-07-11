@extends('front.layouts.default')

@push('css')

@endpush

@push('script')
    <script>
        $(function () {
            $('#preSaveBtn').click (function() {
                $('[name=preSaveFlg]').val(1);
                $('#form1').submit();
            });
            $('#submitBtn').click (function() {
                $('[name=preSaveFlg]').val(0);
            });
        });
    </script>

@endpush

@section('title', 'デザイン確認')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="layout confirm">
                <h1 class="main__title">
                    <img src="{{asset("assets/img/layout/title_confirm.png")}}" alt="デザイン確認">
                </h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li><a href="{{ url('/layout/'. $order_detail['product_id']) }}">レイアウトを作る</a></li>
                        <li>デザイン確認</li>
                    </ul>
                    <div class="design w600">
                        <img src="{!! asset(env('PUBLIC', ''). $order_detail['designed_image']) !!}" alt="デザイン確認">
                    </div>

                    <form method="post" action="{{ url('layout/spec') }}" class="form_template" id="form1">
                        @csrf
                        <input type="hidden" name="preSaveFlg">
                        <input type="hidden" name="order_detail[designed_filename]" value="{{ $order_detail['designed_filename'] }}">
                        <input type="hidden" name="order_detail[designed_image]" value="{{ $order_detail['designed_image'] }}">
                        <input type="hidden" name="order_detail[uploaded_files]" value="{{ $order_detail['uploaded_files'] }}">
                        <input type="hidden" name="order_detail[json]" value="{{ $order_detail['json'] }}">
                        <input type="hidden" name="order[user_id]" value="{{ $order['user_id'] }}">
                        <input type="hidden" name="order_detail[product_id]" value="{{ $order_detail['product_id'] }}">

                        <div class="form__bd">
                            <dl>
                                <dt>デザイン名</dt>
                                <dd>
                                    <input type="text" name="order_detail[design_name]" placeholder=" 例：○○フットボール部　ロゴ" />
                                </dd>
                            </dl>
                            <dl>
                                <dt>備考欄</dt>
                                <dd><textarea name="order_detail[note]"></textarea></dd>
                            </dl>
                        </div>
                        <div class="share cf">
                            <ul class="cf">
                                <li><a href="#"><img src="{{asset("assets/img/layout/share_fb.png")}}" alt="facebook"></a></li>
                                <li><a href="#"><img src="{{asset("assets/img/layout/share_twt.png")}}" alt="Twitter"></a></li>
                                <li><a href="#"><img src="{{asset("assets/img/layout/share_line.png")}}" alt="LINE"></a></li>
                                <li class="btn_org">
                                    <input type="submit" id="preSaveBtn" value="デザインを保存する" />
                                </li>
                            </ul>
                        </div>

                        <div class="btn">
                            <input type="submit" name="submit" id="submitBtn" value="仕様を決める" />
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection