@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="sellcard_box">
            <form method="post" action="{{ route('mobile.sellcard', ['fromuser' => request('fromuser')]) }}">
                <div class="sellcard_bd">
                    <input name="number" class="" placeholder="请输入卡号" type="text">
                </div>
                <div class="sellcard_btn">
                    <button type="submit" class="weui-btn weui-btn_primary">提 交</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection