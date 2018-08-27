@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="weui-msg">
                @if (auth()->user()->personnel)
                    <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                    <div class="weui-msg__text-area">
                        <h2 class="weui-msg__title">已开通卖卡</h2>
                        <p class="weui-msg__desc">业务员 {{ $fromuser->username }} 已为您开通卖卡</p>
                    </div>
                @else
                    <form method="post" action="{{ route('mobile.grantsell', ['fromuser' => request('fromuser')]) }}">
                        <div class="weui-msg__icon-area"><i class="weui-icon-waiting weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">开通卖卡</h2>
                            <p class="weui-msg__desc">业务员 {{ $fromuser->username }} 为您开通卖卡</p>
                        </div>
                        <div class="weui-msg__opr-area">
                            <p class="weui-btn-area">
                                <button type="submit" class="weui-btn weui-btn_primary">提 交</button>
                                <button type="button" class="weui-btn weui-btn_default" id="closeWindow">取 消</button>
                            </p>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript">
            wx.config({!! app('wechat.official_account')->jssdk->buildConfig(array('closeWindow'), false) !!});
            $(function(){
                $(document).on("click", "#closeWindow", function(){
                    wx.closeWindow();
                });
            });
        </script>
    @elseif (strpos(request()->userAgent(), 'AlipayClient') !== false)
        <script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $(document).on("click", "#closeWindow", function(){
                    ap.popWindow();
                });
            });
        </script>
    @else
        <script type="text/javascript">
            $(function(){
                $(document).on("click", "#closeWindow", function(){
                    window.close();
                });
            });
        </script>
    @endif
@endsection