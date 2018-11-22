@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab promotion_card">
        <div class="weui-tab__panel">
            <div class="promotion_card_body">
                <div class="card_load">
                    <div class="tip">正在生成中，请稍候</div>
                </div>
                <div class="card_box">
                    <div class="pic" id="generateimg"></div>
                </div>
            </div>
            <div class="promotion_card_container" id="card_container">
                <div class="card_bg"><img src="{{ asset('static/image/mobile/promotion_bg.jpg') }}" id="cardbgimg"/></div>
                <div class="card_body">
                    <div class="card_user">
                        <div class="headimg"><img src="{{ auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" alt=""></div>
                        <div class="name">{{ auth()->user()->username }}</div>
                    </div>
                    <div class="card_tip">
                        <div class="line1">我为来必惠代言</div>
                        <div class="line2">长按图片识别二维码</div>
                    </div>
                    <div class="card_qrcode">
                        <div class="qrcode"><img src="{{ $qrcode }}" alt="" crossOrigin="anonymous"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
                <button class="weui-btn weui-btn_primary open-popup" data-target="#pop-share">马上分享</button>
            @else
                <button class="weui-btn weui-btn_primary open-popup" data-target="#pop-share">马上分享</button>
            @endif
        </div>
    </div>
    <div class="close-popup" id="pop-share" data-target="#pop-share">
        <img class="" src="{{ asset('static/image/mobile/share-it.png?'.time()) }}">
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/html2canvas.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            setTimeout(function(){
                html2canvas(document.getElementById("card_container"), {allowTaint: false, scale:2}).then(function(canvas) {
                    try {
                        var dataUrl = canvas.toDataURL();
                    }catch(err){
                        alert(err) // 可执行
                    }
                    $('#generateimg').empty().append($('<img/>').attr('src', dataUrl));
                    $('.promotion_card_body .card_load').hide();
                    $('.promotion_card_body .card_box').show();
                });
            }, 500);
        });
    </script>
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

