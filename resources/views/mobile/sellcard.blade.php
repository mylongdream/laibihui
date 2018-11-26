@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="weui-msg">
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">工号：{{ $fromuser->username }}正在为您办卡</h2>
                    <p class="weui-msg__desc">您将在线支付10元费用进行办卡</p>
                    <p class="weui-msg__desc">开卡后可享：到店体验金10元 + 冻结余额90元</p>
                </div>
                <div class="weui-msg__opr-area">
                    <form method="post" action="{{ route('mobile.sellcard', ['fromuser' => request('fromuser')]) }}">
                        {!! csrf_field() !!}
                        <div class="weui-cells sellcard-cell">
                            @if (strpos(request()->userAgent(), 'MicroMessenger') !== false || strpos(request()->userAgent(), 'AlipayClient') !== false)
                                <div class="weui-cell weui-cell_vcode">
                                    <div class="weui-cell__hd"><label class="weui-label">卡  号</label></div>
                                    <div class="weui-cell__bd">
                                        <input class="weui-input" name="number" placeholder="请输入卡号" type="text">
                                    </div>
                                    <div class="weui-cell__ft">
                                        <button id="getcardnum" class="weui-vcode-btn" type="button">扫一扫</button>
                                    </div>
                                </div>
                            @else
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">卡  号</label></div>
                                    <div class="weui-cell__bd">
                                        <input class="weui-input" name="number" placeholder="请输入卡号" type="text">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="weui-btn-area">
                            <button type="submit" class="weui-btn weui-btn_primary" onclick="weui.loading('loading')">提 交</button>
                        </div>
                    </form>
                </div>
                <div class="weui-msg__text-area">
                    <p class="weui-msg__desc">如有疑问请致电：4006-820-917</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (count($errors) > 0)
        <script type="text/javascript">
            weui.alert('{{ $errors->first() }}', {
                isAndroid: false
            });
        </script>
    @endif
    @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript">
            wx.config({!! app('wechat.official_account')->jssdk->buildConfig(array('scanQRCode'), false) !!});
            $(function(){
                $(document).on("click", "#getcardnum", function(){
                    wx.scanQRCode({
                        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                        scanType: ["barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                        success: function (res) {
                            var serialNumber  = res.resultStr;
                            var serial = serialNumber.split(",");
                            serialNumber = serial[serial.length-1];
                            $("input[name='number']").val(serialNumber);
                        }
                    });
                });
            });
        </script>
    @endif
    @if (strpos(request()->userAgent(), 'AlipayClient') !== false)
        <script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $(document).on("click", "#getcardnum", function(){
                    ap.scan({
                        type: 'bar'
                    }, function(res){
                        $("input[name='number']").val(res.code);
                    });
                });
            });
        </script>
    @endif
@endsection