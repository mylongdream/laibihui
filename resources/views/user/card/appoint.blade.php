@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.card.appoint') }}</h3></div>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th width="70" align="left">{{ trans('user.card.appoint.realname') }}</th>
				<th width="120" align="left">{{ trans('user.card.appoint.mobile') }}</th>
				<th align="left">{{ trans('user.card.appoint.address') }}</th>
				<th width="120" align="center">{{ trans('user.card.appoint.created_at') }}</th>
			</tr>
			@if (count($appoints))
				@foreach ($appoints as $value)
					<tr>
						<td align="left">{{ $value->realname }}</td>
						<td align="left">{{ $value->mobile }}</td>
						<td align="left">{{ $value->address }}</td>
						<td align="center">{{ $value->created_at->format('Y-m-d H:i') }}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
	{!! $appoints->links() !!}
@endsection