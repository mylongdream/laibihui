@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                @if (0)
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">恭喜恭喜</h2>
                            <p class="weui-msg__desc">你已开通授权办卡功能</p>
                        </div>
                        <div class="weui-msg__opr-area">
                            <p class="weui-btn-area">
                                <a href="javascript:;" class="weui-btn weui-btn_primary">确定</a>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="topheader">
                        <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                        <div class="nav">申请售卡推广员</div>
                    </div>
                    <div class="weui-article">
                        @if (!auth()->user()->personnel)
                        <p style="text-align: center"><img src="{{ $qrcode }}" alt=""></p>
                        <p style="font-size:18px;color:#f00;">你尚未开通推广售卡服务，请按以下方法操作：</p>
                        <p><a href="{{ route('mobile.user.partner.apply') }}" style="color: blue">立即在线申请推广售卡服务</a></p>
                        <p>立即拨打客服电话<a href="tel:057188253203" style="color: blue">0571-88253203</a>申请推广售卡服务</p>
                        @endif
                        <h2>奖励说明：</h2>
                        <p>推荐一位消费者成功办理来必惠商家联名卡每张提成5元佣金。</p>
                        <p>授权（推荐）一位消费者成功加入售卡推广员可获得7.5元每位的高额佣金。</p>
                        <p>推荐（授权）佣金上不封顶，可实时提现到银行卡。</p>
                        <p>加入售卡推广员的更多福利请点击：<a href="{{ route('mobile.brand.faq.index') }}" style="color: blue">在线客服</a>进行查看。</p>
                        <p>咨询电话：<a href="tel:4006878917" style="color: blue">400-6878-917</a></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection