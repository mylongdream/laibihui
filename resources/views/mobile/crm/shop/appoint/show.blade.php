@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.appoint') }}</div>
                </div>
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__hd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.appoint.status') }}</label>
                            <em class="weui-form-preview__value">{{ trans('user.appoint.status_'.$appoint->status) }}</em>
                        </div>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.appoint.realname') }}</label>
                            <span class="weui-form-preview__value">{{ $appoint->realname }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.appoint.mobile') }}</label>
                            <span class="weui-form-preview__value">{{ $appoint->mobile or '/' }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.appoint.number') }}</label>
                            <span class="weui-form-preview__value">{{ $appoint->number or '0' }} 人</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.appoint.appoint_at') }}</label>
                            <span class="weui-form-preview__value">{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.appoint.remark') }}</label>
                            <span class="weui-form-preview__value">{{ $appoint->remark or '/' }}</span>
                        </div>
                        @if ($appoint->status != 0)
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.appoint.reason') }}</label>
                                <span class="weui-form-preview__value">{{ $appoint->reason or '/' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($appoint->status == 0)
                <div class="weui-btn-area">
                    <a href="javascript:history.back();" class="weui-btn weui-btn_primary">接受预约</a>
                    <a href="javascript:history.back();" class="weui-btn weui-btn_warn">拒绝预约</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
