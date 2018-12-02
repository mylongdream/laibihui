@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">下级撤销办卡</div>
                </div>
                @foreach ($list as $value)
                    <div class="weui-form-preview">
                        <div class="weui-form-preview__bd">
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">申请人</label>
                                <span class="weui-form-preview__value">测试</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">手机号码</label>
                                <span class="weui-form-preview__value">15363263236</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">余卡数量</label>
                                <span class="weui-form-preview__value">3张</span>
                            </div>
                        </div>
                        <div class="weui-form-preview__ft">
                            <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">不同意</a>
                            <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">同意</button>
                        </div>
                    </div>
                @endforeach
                {!! $list->links() !!}
            </div>
        </div>
    </div>
@endsection