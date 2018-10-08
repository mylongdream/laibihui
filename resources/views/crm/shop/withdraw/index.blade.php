@extends('layouts.crm.app')

@section('content')
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.shop.ordermeal.index') }}">
            <div class="crm-search">
                <dl>
                    <dt>查询日期</dt>
                    <dd><input type="text" name="date" class="schtxt" value="{{ request('date') }}" onclick="laydate({max: laydate.now(),format:'YYYY-MM-DD'})"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">备注信息</th>
					<th align="left" width="100">提现金额</th>
					<th align="left" width="100">状态</th>
					<th align="left" width="180">时间</th>
				</tr>
				@foreach ($orders as $value)
					<tr>
						<td>{{ $value->order_sn }}</td>
						<td>{{ $value->order_sn }}</td>
						<td>{{ trans('user.appoint.status_'.$value->status) }}</td>
                        <td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{!! $orders->appends(['date' => request('date')])->links() !!}
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
@endsection