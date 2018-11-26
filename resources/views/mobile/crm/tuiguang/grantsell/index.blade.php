@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav">授权办卡</div>
                        </div>
                        @foreach ($list as $value)
                            <div class="weui-panel">
                                <div class="weui-panel__bd">
                                    <div class="weui-form-preview">
                                        <div class="weui-form-preview__bd">
                                            <div class="weui-media-box weui-media-box_text">
                                                <h4 class="weui-media-box__title">{{ $value->username }}</h4>
                                                <ul class="weui-media-box__info">
                                                    <li class="weui-media-box__info__meta">时间：{{ $value->created_at->format('Y-m-d H:i') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="weui-form-preview__ft">
                                            <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">取消授权</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {!! $list->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="javascript:;" class="weui-tabbar__item tabbar-btn" id="getuserid">
                <span>点击扫一扫申请办卡</span>
            </a>
        </div>
    </div>
@endsection

@section('script')
    @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript">
            wx.config({!! app('wechat.official_account')->jssdk->buildConfig(array('scanQRCode'), false) !!});
            $(function(){
                $(document).on("click", "#getuserid", function(){
                    wx.scanQRCode({
                        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
                        success: function (res) {            // 扫码成功，跳转到二维码指定页面（res.resultStr为扫码返回的结果）
                            location.href = res.resultStr;
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
                $(document).on("click", "#getuserid", function(){
                    ap.scan({
                        type: 'qr'
                    }, function(res){            // 扫码成功，跳转到二维码指定页面（res.resultStr为扫码返回的结果）
                        location.href = res.code;
                    });
                });
            });
        </script>
    @endif
@endsection