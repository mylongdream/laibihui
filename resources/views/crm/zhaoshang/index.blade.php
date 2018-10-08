@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div style="font-size: 18px">我的资产</div>
        <div class="crm-count mtw">
            <table>
                <tr>
                    <td width="40%" align="center" class="sub1"><strong>我的总提成</strong><span><em>{{ $count->cardmoney + $count->shopmoney }}</em>元</span></td>
                    <td width="30%" align="center" class="sub2"><strong>商家售卡提成</strong><span><em>{{ $count->cardmoney }}</em>元</span></td>
                    <td width="30%" align="center" class="sub3"><strong>业绩提成</strong><span><em>{{ $count->shopmoney }}</em>元</span></td>
                </tr>
            </table>
        </div>
        <div class="mtw" style="font-size: 18px">发行管理</div>
        <div class="crm-count mtw">
            <table>
                <tr>
                    <td width="50%" align="center" class="sub2"><strong>分配卡数</strong><span><em>{{ $count->shopcards }}</em>张</span></td>
                    <td width="50%" align="center" class="sub3"><strong>发行卡数</strong><span><em>{{ $count->sellcards }}</em>张</span></td>
                </tr>
            </table>
        </div>
        <div class="mtw" style="font-size: 18px">客户管理</div>
        <div class="crm-count mtw">
            <table>
                <tr>
                    <td align="center" class="sub1"><strong>成功客户</strong><span><em>{{ $count->shops }}</em>个</span></td>
                </tr>
            </table>
        </div>
    </div>
@endsection