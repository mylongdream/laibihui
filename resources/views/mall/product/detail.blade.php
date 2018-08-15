@extends('layouts.common.app')

@section('content')
    <div class="shop-body">
        <div class="wp">
            <div class="product-box cl mtm">
                <div class="product-picview">
                    <div id="preview" class="spec-preview cl">
                        <ul>
                            @if ($product->upphoto)
                                @foreach (unserialize($product->upphoto) as $upphoto)
                                    <li><img class="cloudzoom" data-cloudzoom = "zoomImage: '{{ uploadImage($upphoto, ['width'=>800,'height'=>800,'type'=>2]) }}'" src="{{ uploadImage($upphoto, ['width'=>350,'height'=>350,'type'=>2]) }}" width="350" height="350" /></li>
                                @endforeach
                            @else
                                <li><a href="{{ uploadImage($product->upimage, ['width'=>800,'height'=>800,'type'=>2]) }}"><img class="cloudzoom" src="{{ uploadImage($product->upimage, ['width'=>350,'height'=>350,'type'=>2]) }}" width="350" height="350" /></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="spec-scroll cl">
                        <a class="prev" hidefocus="true" href="javascript:;">&lt;</a>
                        <div class="items cl">
                            <ul>
                                @if ($product->upphoto)
                                    @foreach (unserialize($product->upphoto) as $upphoto)
                                        <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($upphoto, ['width'=>50,'height'=>50,'type'=>2]) }}" width="50" height="50" /></a></li>
                                    @endforeach
                                @else
                                    <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($product->upimage, ['width'=>50,'height'=>50,'type'=>2]) }}" width="50" height="50" /></a></li>
                                @endif
                            </ul>
                        </div>
                        <a class="next" hidefocus="true" href="javascript:;">&gt;</a>
                    </div>
                </div>
                <div class="product-intro">
                        <div class="p-name">
                            <h1>{{ $product->name }}</h1>
                            <div class="p-ad"></div>
                        </div>
                        <div class="p-line">
                            <dl class="cl">
                                <dt>市场价：</dt>
                                <dd>{{ $product->price }}</dd>
                            </dl>
                        </div>
                    <div class="p-line">
                        <dl class="cl">
                            <dt>所需积分：</dt>
                            <dd>{{ $product->score }}</dd>
                        </dl>
                    </div>
                        <div class="p-amount">
                            <dl class="cl">
                                <dt>数量：</dt>
                                <dd>
                                    <div class="sell_num">
                                        <span class="cut_num"></span>
                                        <input id="countBuy" class="key_num" type="text" value="1" name="buy_num" size="15" maxlength="6">
                                        <span class="add_num"></span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="p-btns cl">
                            <div class="product-appoint"><a rel="nofollow" href="">马上兑换</a></div>
                        </div>
                </div>
            </div>

            <div class="cl ct_product mtm">
                <div class="side">
                    <div class="product-recommend">
                        <div class="hd">
                            <span>商品推荐</span>
                        </div>
                        <div class="bd">
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-new mtm">
                        <div class="hd">
                            <span>最新商品</span>
                        </div>
                        <div class="bd">
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="main">
                    <div class="product-tabbar">
                        <ul>
                            <li class="a"><span>商品详情</span></li>
                        </ul>
                    </div>
                    <div class="product-detail cl">
                        {!! $product->message !!}
                    </div>
                </div>
            </div>



        </div>
    </div>
    <script type="text/javascript" src="{{ asset('static/js/jquery.CloudZoom.js') }}"></script>
    <script type="text/javascript">
        CloudZoom.quickStart();
        $(".product-picview").slide({ titCell:".spec-scroll li", mainCell:".spec-preview ul", effect:"fold", delayTime:200});
        $(".spec-scroll").slide({ mainCell:"ul",delayTime:100,vis:5,effect:"left",autoPage:true,prevCell:".prev",nextCell:".next" });
    </script>
@endsection