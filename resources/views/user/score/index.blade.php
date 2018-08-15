@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.score') }}</h3></div>
		<ul class="tab">
			<li class="on"><a href="{{ route('user.score.index') }}"><span>{{ trans('user.score.list') }}</span></a></li>
			<li><a href="{{ route('user.score.exchange') }}"><span>{{ trans('user.score.exchange') }}</span></a></li>
			<li><a href="{{ route('user.score.transfer') }}"><span>{{ trans('user.score.transfer') }}</span></a></li>
		</ul>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left">{{ trans('user.score.remark') }}</th>
				<th align="center">{{ trans('user.score.score') }}</th>
				<th align="center" width="120">{{ trans('user.score.created_at') }}</th>
			</tr>
			@if (count($scores))
				@foreach ($scores as $value)
					<tr>
						<td align="left">{{ $value->remark }}</td>
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
					<td colspan="3" align="center" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
	{!! $scores->links() !!}
@endsection