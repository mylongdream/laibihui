@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li><a href="{{ route('crm.shop.lackcard.checkin') }}">缺卡登记</a></li>
            <li class="on"><a href="{{ route('crm.shop.lackcard.index') }}">订卡记录</a></li>
        </ul>
    </div>
	<div class="crm-main">
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">订卡数量</th>
					<th align="left" width="150">订卡时间</th>
					<th align="left" width="120">状态</th>
				</tr>
				@foreach ($list as $value)
					<tr>
						<td>{{ $value->cardnum }} 张</td>
						<td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
						<td>{{ $value->status ? '已处理' : '待处理' }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{!! $list->links() !!}
	</div>
@endsection