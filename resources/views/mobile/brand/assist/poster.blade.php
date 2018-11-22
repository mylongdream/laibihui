@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab assist_card">
        <div class="weui-tab__panel">
            <div class="assist_card_body">
                <div class="card_load">
                    <div class="tip">正在生成中，请稍候</div>
                </div>
                <div class="card_box">
                    <div class="pic" id="generateimg"></div>
                    <div class="tip"><span>长按上图保存图片，或发送给朋友</span></div>
                </div>
            </div>
            <div class="assist_card_container" id="card_container">
                <div class="card_bg"><img src="{{ asset('static/image/mobile/assist/cardbg_01.jpg') }}" id="cardbgimg"/></div>
                <div class="card_body">
                    <div class="card_box">
                        <div class="pic"><img src="{{ uploadImage($info->upimage) }}" alt=""></div>
                        <div class="tit">{{ $info->name }}</div>
                        <div class="price">
                            <div class="z">仅剩<span>{{ $info->leftnum }}</span>份</div>
                            <div class="y">市场价<em>￥</em><strong>{{ $info->price }}</strong></div>
                        </div>
                        <div class="copy">— 快来和我一起{{ $info->price ? '领取' : '免费领取' }}吧！ —</div>
                    </div>
                    <div class="card_qrcode">
                        <div class="qrcode z"><img src="{{ $qrcode }}" alt=""></div>
                        <div class="fingp y"><img src="{{ asset('static/image/mobile/assist/zhiwen.png') }}" alt=""> </div>
                    </div>
                    <div class="card_tip">长按识别二维码{{ $info->price ? '领取' : '免费领取' }}</div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <div class="assist_card_footer">
                <ul>
                    <li data-card="{{ asset('static/image/mobile/assist/cardbg_01.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_01_small.jpg') }}"/> </li>
                    <li data-card="{{ asset('static/image/mobile/assist/cardbg_02.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_02_small.jpg') }}"/> </li>
                    <li data-card="{{ asset('static/image/mobile/assist/cardbg_03.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_03_small.jpg') }}"/> </li>
                    <li data-card="{{ asset('static/image/mobile/assist/cardbg_04.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_04_small.jpg') }}"/> </li>
                    <li data-card="{{ asset('static/image/mobile/assist/cardbg_05.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_05_small.jpg') }}"/> </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/html2canvas.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".assist_card_footer li", function(){
                $(this).addClass("on").siblings().removeClass("on");
                $('#cardbgimg').attr("src",$(this).attr("data-card"));
                $('.assist_card_body .card_load').show();
                $('.assist_card_body .card_box').hide();
                html2canvas(document.getElementById("card_container"), {allowTaint: false, scale:2}).then(function(canvas) {
                    try {
                        var dataUrl = canvas.toDataURL();
                    }catch(err){
                        alert(err) // 可执行
                    }
                    $('#generateimg').empty().append($('<img/>').attr('src', dataUrl));
                    $('.assist_card_body .card_load').hide();
                    $('.assist_card_body .card_box').show();
                });
            });
            $(".assist_card_footer li:first").trigger("click");
        });
    </script>
@endsection