@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab assist_card">
        <div class="weui-tab__panel">
            <div class="assist_card_body">
                <div class="card_load">
                    <div class="wave">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                    <div class="tip">正在生成中，请稍候</div>
                </div>
                <div class="card_box">
                    <div class="pic" id="generateimg"></div>
                    <div class="tip"><span>长按上图保存图片，或发送给朋友</span></div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <div class="assist_card_footer">
                <ul>
                    <li class="on" data-card="{{ asset('static/image/mobile/assist/cardbg_01.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_01_small.jpg') }}"/> </li>
                    <li class="" data-card="{{ asset('static/image/mobile/assist/cardbg_02.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_02_small.jpg') }}"/> </li>
                    <li class="" data-card="{{ asset('static/image/mobile/assist/cardbg_03.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_03_small.jpg') }}"/> </li>
                    <li class="" data-card="{{ asset('static/image/mobile/assist/cardbg_04.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_04_small.jpg') }}"/> </li>
                    <li class="" data-card="{{ asset('static/image/mobile/assist/cardbg_05.jpg') }}"><img src="{{ asset('static/image/mobile/assist/cardbg_05_small.jpg') }}"/> </li>
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
                var newImg = document.createElement("img");
                newImg.src =  $(this).attr("data-card");
                $('#generateimg').appendChild(newImg);
                $('.card_load').hide();
                $('.card_box').show();
            });
        });
    </script>
@endsection