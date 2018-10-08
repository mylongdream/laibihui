@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-list mtw">
            <div class="crm-bar">
                <div class="z"><span>店铺名称：{{ $shop->name }}</span></div>
            </div>
            <table>
                <tr>
                    <th align="left">分配时间</th>
                    <th align="left" width="160">已分配</th>
                    <th align="left" width="120">分配数量</th>
                    <th align="left" width="120">分配价格</th>
                    <th align="left" width="80">操作</th>
                </tr>
                @foreach ($allots as $value)
                    <tr>
                        <td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
                        <td><a href="{{ route('crm.zhaoshang.shop.card', ['id' => $shop->id, 'allotid' => $value->id]) }}">{{ $value->cardlist->count() }} 张</a></td>
                        <td>{{ $value->quantity }} 张</td>
                        <td>{{ $value->price }} 元</td>
                        <td>
                            @if ($value->quantity > $value->cardlist->count())
                            <a href="{{ route('crm.zhaoshang.shop.addcard', ['id' => $shop->id, 'allotid' => $value->id]) }}" class="openwindow" title="导入卡号">导入卡号</a>
                            @else
                                <span>已分配完</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $allots->links() !!}
    </div>
@endsection