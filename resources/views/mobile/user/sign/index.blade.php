@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="roulette-container">
                <div class="roulette-top">
                    <img width="100%" src="{{ asset('static/image/mobile/sign-top.png') }}" alt="">
                </div>
                <div class="roulette-box">
                    <div class="pan-back">
                        <div class="pan-area">
                            <ul class="item-wrap item-wrap{{ count($prize) }}">
                                @foreach ($prize as $value)
                                    <li style="transform: rotate({{ (2*$loop->iteration-3)*180/$loop->count - 270 }}deg) skew({{ 90-360/$loop->count }}deg);-webkit-transform: rotate({{ (2*$loop->iteration-3)*180/$loop->count - 270 }}deg) skew({{ 90-360/$loop->count }}deg);-ms-transform: rotate({{ (2*$loop->iteration-3)*180/$loop->count - 270 }}deg) skew({{ 90-360/$loop->count }}deg);-o-transform: rotate({{ (2*$loop->iteration-3)*180/$loop->count - 270 }}deg) skew({{ 90-360/$loop->count }}deg);">
                                        <div style="transform: skew(-{{ 90-360/$loop->count }}deg) rotate(-{{ 90-180/$loop->count }}deg);-webkit-transform: skew(-{{ 90-360/$loop->count }}deg) rotate(-{{ 90-180/$loop->count }}deg);-ms-transform: skew(-{{ 90-360/$loop->count }}deg) rotate(-{{ 90-180/$loop->count }}deg);-o-transform: skew(-{{ 90-360/$loop->count }}deg) rotate(-{{ 90-180/$loop->count }}deg);">
                                            <span>{{ $value['title'] }}</span>
                                            <img src="{{ $value['img'] }}">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="pan-mask"></div>
                        </div>
                        <div class="btn-area btn-start">
                            <div class="go-arrow"><span></span></div>
                            <div class="go-back">
                                <span>开始</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-btn-area">
                    @if ($todaysign)
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary bg-gray">今日已签到</button>
                    @else
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary btn-start">点击签到</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.rotate.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.btn-start', function() {
                $.ajax({
                    type:"POST",
                    url:"{{ route('mobile.user.sign.store') }}"
                }).success(function(data) {
                    if(data.status == 1){
                        var angle = 1800 + parseInt(data.angle);
                        $(".go-arrow").rotate({
                            angle:0,
                            animateTo:angle,
                            duration:8000,
                            callback:function (){
                                weui.alert(data.info, function(){
                                    if(data.url){
                                        window.location.href = data.url;
                                    } else {
                                        window.location.reload();
                                    }
                                }, {
                                    title: '签到成功'
                                });
                            }
                        })
                    } else {
                        weui.alert(data.info, { title: '签到失败' });
                    }
                }).error(function(data) {
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            weui.alert(value, { title: '签到失败' });
                            return false;
                        });
                        return false;
                    }
                });
                return false;
            });
        });
    </script>
@endsection