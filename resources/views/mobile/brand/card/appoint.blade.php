@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="topheader">
                        <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                        <div class="nav">我要办卡</div>
                    </div>
                    <div class="">
                        <p>
                            <img width="100%" style="display: block" src="{{ asset('static/image/mobile/card1.jpg') }}" alt="">
                        </p>
                        <p>
                            <img width="100%" style="display: block" src="{{ asset('static/image/mobile/card2.jpg') }}" alt="">
                        </p>
                        <p>
                            <img width="100%" style="display: block" src="{{ asset('static/image/mobile/card4.jpg') }}" alt="">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            @auth
            <a href="javascript:;" class="weui-tabbar__item tabbar-btn open-popup">
                <span>点击办卡</span>
            </a>
            @else
                <a href="{{ route('mobile.login') }}" class="weui-tabbar__item tabbar-btn">
                    <span>登录后再办卡</span>
                </a>
                @endauth
        </div>
    </div>
    <div class="popup-container">
        <div class="wp">
            <div class="pbw">
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.card.appoint') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells__title">您的姓名</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="realname" placeholder="请输入您的姓名" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">性别</div>
                    <div class="weui-cells weui-cells_radio">
                        <label class="weui-cell weui-check__label" for="x11">
                            <div class="weui-cell__bd">
                                <p>男</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="gender" id="x11" type="radio" checked="checked">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="x12">
                            <div class="weui-cell__bd">
                                <p>女</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="gender" id="x12" type="radio">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    </div>
                    <div class="weui-cells__title">联系地址</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="address" placeholder="请输入联系地址" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">联系QQ</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="qq" placeholder="请输入联系QQ" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">备注信息</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <textarea class="weui-textarea" placeholder="请输入备注信息" rows="3" name="remark"></textarea>
                                <div class="weui-textarea-counter"><span>0</span>/200</div>
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">立即办卡</button>
                        <button class="weui-btn weui-btn_default close-popup" value="true" name="cancelbtn" type="button">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("click", ".open-popup", function(){
            $('.popup-container').show();
            return false;
        });
        $(document).on("click", ".close-popup", function(){
            $('.popup-container').hide();
            return false;
        });
    </script>
@endsection