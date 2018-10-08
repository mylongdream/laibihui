@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li><a href="{{ route('crm.shop.consume.index') }}">消费明细</a></li>
            <li class="on"><a href="{{ route('crm.shop.consume.balance') }}">每日结算</a></li>
        </ul>
    </div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.shop.consume.balance') }}">
            <div class="crm-search">
                <dl>
                    <dt>查询月份</dt>
                    <dd><input type="text" name="month" class="schtxt" value="{{ $datetime->format('Y-m') }}" onclick="laydate({max: laydate.now(-1),format:'YYYY-MM'})"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">时间</th>
					<th align="left">线上支付</th>
					<th align="left">线下付款</th>
					<th align="left">实收金额</th>
				</tr>
				@if (count($consumes))
				@foreach ($consumes as $value)
					<tr>
						<td>{{ $value->date->format('Y-m-d') }}</td>
						<td><strong>￥{{ sprintf("%.2f",$value->online) }}</strong></td>
						<td><strong>￥{{ sprintf("%.2f",$value->offline) }}</strong></td>
						<td><strong>￥{{ sprintf("%.2f",$value->account) }}</strong></td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="4" class="nodata">暂无数据</td>
					</tr>
				@endif
			</table>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
@endsection