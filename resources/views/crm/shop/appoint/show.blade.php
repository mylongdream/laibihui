@extends('layouts.crm.app')

@section('content')
    @if (!request()->ajax())
	<div class="crm-main">
    <div class="order-show mtw">
        <table>
            <tr>
                <th width="150" align="right">订单编号</th>
					<td>{{ $appoint->order_sn or '/' }}</td>
            </tr>
            <tr>
                <th align="right">姓名</th>
					<td>{{ $appoint->realname }}</td>
            </tr>
            <tr>
                <th align="right">手机</th>
					<td>{{ $appoint->mobile or '/' }}</td>
            </tr>
            <tr>
                <th align="right">预约人数</th>
					<td>{{ $appoint->number or '0' }} 人</td>
            </tr>
            <tr>
                <th align="right">预约时间</th>
					<td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
            </tr>
            <tr>
                <th align="right">备注信息</th>
					<td>{{ $appoint->remark or '/' }}</td>
            </tr>
        </table>
    </div>
    </div>
    @else
        <div class="order-show" style="width: 500px;">
        <table>
            <tr>
                <th width="120" align="right">订单编号</th>
					<td>{{ $appoint->order_sn or '/' }}</td>
            </tr>
            <tr>
                <th align="right">姓名</th>
					<td>{{ $appoint->realname }}</td>
            </tr>
            <tr>
                <th align="right">手机</th>
					<td>{{ $appoint->mobile or '/' }}</td>
            </tr>
            <tr>
                <th align="right">预约人数</th>
					<td>{{ $appoint->number or '0' }} 人</td>
            </tr>
            <tr>
                <th align="right">预约时间</th>
					<td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
            </tr>
            <tr>
                <th align="right">备注信息</th>
					<td>{{ $appoint->remark or '/' }}</td>
            </tr>
        </table>
    </div>
    @endif
@endsection