@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.appoint') }}</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.user.appoint.cancel', $appoint->order_sn) }}">
                    {!! csrf_field() !!}
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__bd">
                            <a href="{{ route('mobile.brand.shop.show', ['id' => $appoint->shop->id]) }}" class="weui-cell weui-cell_access">
                                <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                                    <img src="{{ uploadImage($appoint->shop->upimage) }}" style="width: 50px;height: 50px;display: block">
                                </div>
                                <div class="weui-cell__bd">
                                    <p>{{ $appoint->shop ? $appoint->shop->name : '/' }}</p>
                                    <p style="font-size: 13px;color: #888888;">电话：{{ $appoint->shop ? $appoint->shop->phone : '/' }}</p>
                                </div>
                                <div class="weui-cell__ft"></div>
                            </a>
                        </div>
                    </div>
                    <div class="weui-cells__title">取消原因</div>
                    <div class="weui-cells weui-cells_radio">
                        <label class="weui-cell weui-check__label" for="reason1">
                            <div class="weui-cell__bd">
                                <p>预约信息填写错误</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="reason" id="reason1" type="radio" value="预约信息填写错误" checked="checked">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="reason2">
                            <div class="weui-cell__bd">
                                <p>我想静静</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="reason" id="reason2" type="radio" value="我想静静">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="reason3">
                            <div class="weui-cell__bd">
                                <p>商家态度差</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="reason" id="reason3" type="radio" value="商家态度差">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="reason4">
                            <div class="weui-cell__bd">
                                <p>太贵了放弃预约</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="reason" id="reason4" type="radio" value="太贵了放弃预约">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="reason5">
                            <div class="weui-cell__bd">
                                <p>已经预约了</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="reason" id="reason5" type="radio" value="已经预约了">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="reason6">
                            <div class="weui-cell__bd">
                                <p>不想预约了</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="reason" id="reason6" type="radio" value="不想预约了">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
