@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">申请授权办卡员记录</div>
                </div>
                <div class="weui-cells weui-panel">
                    @foreach ($orders as $value)
                        <div class="weui-form-preview">
                            <div class="weui-form-preview__bd">
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">姓名</label>
                                    <span class="weui-form-preview__value">{{ $value->realname }}</span>
                                </div>
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">手机号</label>
                                    <span class="weui-form-preview__value">{{ $value->mobile }}</span>
                                </div>
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">微信号</label>
                                    <span class="weui-form-preview__value">{{ $value->wechatid }}</span>
                                </div>
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">联系地址</label>
                                    <span class="weui-form-preview__value">{{ $value->address }}</span>
                                </div>
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">其他要求</label>
                                    <span class="weui-form-preview__value">{{ $value->remark }}</span>
                                </div>
                            </div>
                            <div class="weui-form-preview__ft">
                                @if ($value->status)
                                    <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">已受理</a>
                                @else
                                    <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">等待受理</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
@endsection
