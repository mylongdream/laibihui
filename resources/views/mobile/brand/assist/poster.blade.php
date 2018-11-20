@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab assist_card">
        <div class="weui-tab__panel">
            <div class="assist_card_body">
                <div class="inner">


                </div>
                <div class="tip"><span>长按上图保存图片，或发送给朋友</span></div>
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
            });
        });
    </script>
@endsection