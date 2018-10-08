@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="shop-info">
            <div class="pic">
                <img src="{{ uploadImage(auth('crm')->user()->shop->upimage) }}" width="100" height="100">
            </div>
            <div class="info">
                <div class="shop-stuff">
                    <span><strong>{{ auth('crm')->user()->shop->name }}</strong></span>
                </div>
                <div class="shop-assets">
                    <span>账户余额：</span>{{ sprintf("%.2f",auth('crm')->user()->shop->account) }}元
                </div>
                <div class="shop-function">
                    本店支持：
                    @if (auth('crm')->user()->shop->offline)
                        <span>线下付款</span>
                    @endif
                    @if (auth('crm')->user()->shop->appoint)
                        <span>预约订座</span>
                    @endif
                    @if (auth('crm')->user()->shop->ordermeal)
                        <span>在线点餐</span>
                    @endif
                    @if (auth('crm')->user()->shop->ordercard)
                        <span>店内办卡</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="mtw" style="font-size: 18px">昨日收入</div>
        <div class="crm-count mtw">
            <table>
                <tr>
                    <td width="40%" align="center" class="sub1"><strong>昨日收入</strong><span>￥<em>{{ sprintf("%.2f",$count->consume_account) }}</em></span></td>
                    <td width="30%" align="center" class="sub2"><strong>昨日线上支付</strong><span>￥<em>{{ sprintf("%.2f",$count->consume_online) }}</em></span></td>
                    <td width="30%" align="center" class="sub3"><strong>昨日线下支付</strong><span>￥<em>{{ sprintf("%.2f",$count->consume_offline) }}</em></span></td>
                </tr>
            </table>
        </div>
        @if (auth('crm')->user()->shop->ordercard)
            <div class="mtw" style="font-size: 18px">店内办卡</div>
            <div class="crm-count mtw">
                <table>
                    <tr>
                        <td width="40%" align="center" class="sub1"><strong>发卡提成</strong><span>￥<em>{{ sprintf("%.2f",$count->ordercard_account) }}</em></span></td>
                        <td width="30%" align="center" class="sub2"><strong>未发行卡数</strong><span><em>{{ $count->ordercard_remaincard }}</em></span></td>
                        <td width="30%" align="center" class="sub3"><strong>已发行卡数</strong><span><em>{{ $count->ordercard_sellcard }}</em></span></td>
                    </tr>
                </table>
            </div>
            @if ($rewards)
            <div class="mtw" style="font-size: 18px">奖励兑换</div>
            <div class="crm-exchange mtw">
                <ul>
                    @foreach ($rewards as $value)
                    <li>
                        <div class="pic"><img src="{{ uploadImage($value->upimage) }}" width="60" height="60"></div>
                        <div class="name">{{ $value->name }}</div>
                        <div class="info">所需卡数：{{ $value->cardnum }}张</div>
                        <div class="btn"><a href="javascript:;" class="disabled">点击兑换</a></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        @endif
    </div>
@endsection