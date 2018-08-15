@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="">
            <div class="wp pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">店铺资质</div>
                </div>
                <div class="shop-zizhi">
                    @if ($shop->pic_zizhi)
                        @foreach (unserialize($shop->pic_zizhi) as $upphoto)
                            <p><img src="{{ uploadImage($upphoto) }}" alt=""></p>
                        @endforeach
                    @else
                        <div style="font-size: 18px;text-align: center;padding: 60px 10px;">暂无图片</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
