@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="weui-panel">
                <div class="weui-panel__bd">
                    <img style="width:100%" src="{{ route('mobile.user.promotion.qrcode', ['getcode' => 1]) }}" alt="">
                </div>
            </div>
            @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
            <div class="weui-btn-area">
                <button class="weui-btn weui-btn_primary open-popup" data-target="#pop-share">马上分享</button>
            </div>
            @endif
        </div>
    </div>
    <div class="close-popup" id="pop-share" data-target="#pop-share">
        <img class="" src="{{ asset('static/image/mobile/share-it.png?'.time()) }}">
    </div>
@endsection

@section('script')
    @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript">
        wx.config({!! app('wechat.official_account')->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo'), false) !!});
        wx.ready(function() {
            wx.onMenuShareAppMessage({
                title: '',
                desc: '',
                link: '{{ $shareData['link'] }}',
                imgUrl: ''
            });
            wx.onMenuShareTimeline({
                title: '',
                link: '{{ $shareData['link'] }}',
                imgUrl: ''
            });
        });
    </script>
    @endif
@endsection

