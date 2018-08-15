@extends('layouts.user.app')

@section('content')
    <div class="itemnav">
        <div class="title"><h3>{{ trans('user.appoint') }}</h3></div>
    </div>
    @if (count($appoints))
        <div class="order-list mtw">
            <div class="hd">
                <table width="100%">
                    <tr>
                        <th width="52%" align="center">{{ trans('user.appoint.shop') }}</th>
                        <th width="14%" align="center">{{ trans('user.appoint.appoint_at') }}</th>
                        <th width="10%" align="center">{{ trans('user.appoint.number') }}</th>
                        <th width="12%" align="center">{{ trans('user.appoint.status') }}</th>
                        <th width="12%" align="center">{{ trans('user.operation') }}</th>
                    </tr>
                </table>
            </div>
            @foreach ($appoints as $value)
            <div class="bd mtw">
                    <table width="100%">
                        <tr class="tr-th">
                            <td colspan="5">
                                <span class="dealtime">{{ $value->created_at->format('Y-m-d H:i:s') }}</span>
                                <span class="ordersn">订单号：<a href="{{ route('user.appoint.show', $value->order_sn) }}" title="订单详情" class="openwindow">{{ $value->order_sn }}</a></span>
                                @if ($value->status == 2)
                                    <span class="reason" title="{{ $value->reason or '无' }}"><nobr>拒绝原因：<em>{{ $value->reason or '无' }}</em></nobr></span>
                                @endif
                                @if ($value->status == 3)
                                    <span class="reason" title="{{ $value->reason or '无' }}"><nobr>取消原因：<em>{{ $value->reason or '无' }}</em></nobr></span>
                                @endif
                            </td>
                        </tr>
                        <tr class="tr-bd">
                            <td width="52%" valign="top">
                                @if ($value->shop)
                                    <div class="s-item">
                                        <div class="s-pic">
                                            <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">
                                                <img src="{{ uploadImage($value->shop->upimage) }}" width="150" height="150">
                                            </a>
                                        </div>
                                        <div class="s-info">
                                            <div class="s-name">
                                                <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">{{ $value->shop->name }}</a>
                                            </div>
                                            <div class="s-extra">
                                                电话：{{ $value->shop->phone }}
                                            </div>
                                            <div class="s-extra">
                                                地址：{{ $value->shop->address }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    /
                                @endif
                            </td>
                            <td width="14%" align="center">{{ $value->appoint_at ? $value->appoint_at->format('Y-m-d H:i') : '/' }}</td>
                            <td width="10%" align="center">{{ $value->number }} 人</td>
                            <td width="12%" align="center">
                                <p class="order-status">{{ trans('user.appoint.status_'.$value->status) }}</p>
                                <p><a href="{{ route('user.appoint.show', $value->order_sn) }}" title="订单详情" class="openwindow">订单详情</a></p>
                            </td>
                            <td width="12%" align="center">
                                @if ($value->status == 0)
                                    <a href="{{ route('user.appoint.cancel', $value->order_sn) }}" title="取消预约" class="openwindow btn-cancel">取消预约</a>
                                @else
                                    @if ($value->shop)
                                        <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="再次预约" class="btn-again">再次预约</a>
                                @endif
                                @endif
                            </td>
                        </tr>
                    </table>
            </div>
            @endforeach
        </div>
        {!! $appoints->links() !!}
    @else
        <div class="tblist mtw">
            <table>
                <tr>
                    <td colspan="3" class="nodata">暂无数据</td>
                </tr>
            </table>
        </div>
    @endif
@endsection