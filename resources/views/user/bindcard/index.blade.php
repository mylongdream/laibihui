@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.bindcard') }}</h3></div>
	</div>
	<div class="bindcard-top mtw">
        <div class="bindcard-info">
            <div class="hd">我的{{ $setting['sitename'] }}联名卡</div>
            <div class="bd">
                <ul>
                    <li><span>账户积分</span><em>{{auth()->user()->score}} 个</em></li>
                    <li><span>到店体验金</span><em>{{auth()->user()->tiyan_money}} 元</em></li>
                    <li><span>冻结余额</span><em>{{auth()->user()->frozen_money}} 元</em></li>
                    <li><span>可用余额</span><em>{{auth()->user()->user_money}} 元</em></li>
                    <li><span>消费总额</span><em>{{auth()->user()->consume_money}} 元</em></li>
                </ul>
            </div>
        </div>
        <div class="bindcard-form">
		@if ($card)
                <table width="100%" style="font-size:24px;">
                    <tr>
                        <td height="100" align="center">恭喜您已成功绑卡</td>
                    </tr>
                    <tr>
                        <td height="60" align="center">卡号为</td>
                    </tr>
                    <tr>
                        <td height="30" align="center">{{ $card->number }}</td>
                    </tr>
                </table>
		@else
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.bindcard.index') }}">
                    {!! csrf_field() !!}
                    <table width="100%">
                        <tr>
                            <td height="60" align="center"><input class="input numeric" type="text" size="50" value="" name="number" placeholder="请输入卡号"></td>
                        </tr>
                        <tr>
                            <td height="60" align="center"><input class="input" type="password" size="50" value="" name="password" placeholder="请输入密码"></td>
                        </tr>
                        @if (!auth()->user()->mobile)
                        <tr>
                            <td width="150" align="right">{{ trans('user.profile.mobile') }}</td>
                            <td>
                                <input id="form-mobile" type="text" name="mobile" class="input">
                            </td>
                        </tr>
                        <tr>
                            <td width="150" align="right">验证码</td>
                            <td>
                                <input id="form-smscode" type="text" name="smscode" class="input verify">
                                <input type="hidden" name="mobilerule" value="register">
                                <button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td height="80" align="center"><button value="true" name="savesubmit" type="submit" class="button">确定绑定</button></td>
                        </tr>
                        <tr>
                            <td height="20" align="center"><a href="{{ route('brand.card.index') }}" target="_blank" class="text-red">我还没有卡，立即前去办卡</a></td>
                        </tr>
                    </table>
                </form>
        @endif
        </div>
        <div class="bindcard-how">
            <div class="hd">如何绑定{{ $setting['sitename'] }}商家联名卡？</div>
            <div class="bd">
                <p>请将获得的{{ $setting['sitename'] }}商家联名卡卡号密码输入左侧卡密填写框，点击确定绑定（如已绑定请忽略），绑定成功后，该张{{ $setting['sitename'] }}商家联名卡只能在本账户下使用，同时可在线下使用，如有疑问请联系我们，在此，祝你消费愉快！</p>
            </div>
        </div>
	</div>
    <div class="bindcard-what mtw">
        <div class="hd">什么是{{ $setting['sitename'] }}商家联名卡？</div>
        <div class="bd">
            <p>{{ $setting['sitename'] }}商家联名卡可在{{ $setting['sitename'] }}（www.zhihu365.vip）线下合作的吃喝玩乐、衣食住行的联名商家到店支付使用，以及{{ $setting['sitename'] }}物商城中使用的一种带有可储值的卡，同时我们针对线下有意向的合作商家可提供卡面个性化定制服务。
                @if ($card)
                    <a href="{{ route('user.promotion.index') }}" class="text-red">推荐朋友办卡开始赚钱></a>
                @else
                    <a href="{{ route('brand.card.index') }}" target="_blank" class="text-red">立即购买知惠网商家联名卡></a>
                @endif
            </p>
            <p>{{ $setting['sitename'] }}商家联名卡主要有二种消费模式，下面我们分别为你介绍下：</p>
            <p>第一种消费模式：当你拿到本卡后绑定{{ $setting['sitename'] }}APP就可以在{{ $setting['sitename'] }}联名合作的所有商家到店消费按商家标牌价打折。（可充值也可不充值，可跨行业消费）</p>
            <p>第二种消费模式：若你的{{ $setting['sitename'] }}联名卡内有余额或积分时，你可以在{{ $setting['sitename'] }}购物商城内进行购买你喜欢的商品</p>
        </div>
    </div>
    <div class="bindcard-more mtw">
        <a href="{{ route('about.faq') }}" target="_blank">查看更多问题></a>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl:"{{ route('util.smscode') }}",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
@endsection