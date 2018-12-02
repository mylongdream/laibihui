@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            @if ($status)
                <div class="weui-msg">
                    <div class="weui-msg__icon-area"><i class="weui-icon-waiting weui-icon_msg"></i></div>
                    <div class="weui-msg__text-area">
                        <h2 class="weui-msg__title">撤销申请成功</h2>
                        <p class="weui-msg__desc">我们已安排工作人员或商家办理退卡业务</p>
                        <p class="weui-msg__desc">请准备好余卡耐心等待</p>
                    </div>
                    <div class="weui-msg__opr-area">
                        <p class="weui-btn-area">
                            <a href="javascript:history.back();" class="weui-btn weui-btn_primary">确定</a>
                        </p>
                    </div>
                </div>
            @else
                <form method="post" action="{{ route('mobile.crm.tuiguang.grantsell.apply') }}">
                    {!! csrf_field() !!}
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-waiting weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">撤销授权办卡</h2>
                            <p class="weui-msg__desc">你确定要退出售卡推广员吗？</p>
                        </div>
                        <div class="weui-msg__opr-area">
                            <p class="weui-btn-area">
                                <button type="submit" class="weui-btn weui-btn_primary" onclick="weui.loading('loading')">确定</button>
                            </p>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection