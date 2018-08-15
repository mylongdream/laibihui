@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.sign') }}</h3></div>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left">{{ trans('user.sign.remark') }}</th>
				<th align="center">{{ trans('user.sign.score') }}</th>
				<th align="center" width="120">{{ trans('user.sign.created_at') }}</th>
			</tr>
			@if (count($signs))
				@foreach ($signs as $value)
					<tr>
						<td align="left">每日签到</td>
						<td align="center">
							@if ($value->score > 0)
								<strong style="color:#e4393c">+{{ $value->score }}</strong>
							@else
								<strong style="color:#999999">{{ $value->score }}</strong>
							@endif
						</td>
						<td align="center">{{ $value->created_at->format('Y-m-d H:i') }}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="3" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
	{!! $signs->links() !!}
@endsection