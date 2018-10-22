@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">缺卡登记</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.crm.shop.sellcard.checkin') }}">
                    {!! csrf_field() !!}
                    <div class="weui-article">
                        <p>尊敬的商户您好!请您按照实际用卡数量完成订卡申请，您的客户经理将免费为您送卡上门，谢谢</p>
                        <p>您当前余卡数量：{{ $leftcardnum }}</p>
                    </div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <input class="weui-input" placeholder="请输入本次订卡数量" type="text" name="cardnum">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">立即预定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
