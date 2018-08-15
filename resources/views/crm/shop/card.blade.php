@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.shop.card', ['id' => $shop->id, 'allotid' => request('allotid')]) }}">
            <div class="crm-search">
                <dl>
                    <dt>卡号</dt>
                    <dd><input type="text" name="number" class="schtxt" value="{{ request('number') }}"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <div class="crm-bar">
                <div class="z"><span>店铺名称：{{ $shop->name }}</span></div>
                <div class="y"><a href="{{ route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => request('allotid')]) }}" class="btn openwindow" title="导入卡号">+ 导入卡号</a></div>
            </div>
            <table>
                <tr>
                    <th align="left">卡号</th>
                    <th align="left" width="160">状态</th>
                    <th align="left" width="120">分配时间</th>
                </tr>
                @foreach ($cards as $value)
                    <tr>
                        <td>{{ $value->number }}</td>
                        <td>{{ $value->card ? '已开卡' : '待开卡' }}</td>
                        <td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $cards->appends(['number' => request('number')])->links() !!}
    </div>
@endsection