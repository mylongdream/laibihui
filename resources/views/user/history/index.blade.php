@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.history') }}</h3></div>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left" width="160">{{ trans('user.history.shop') }}</th>
				<th align="left" width="120">{{ trans('user.history.shop.phone') }}</th>
				<th align="left">{{ trans('user.history.shop.address') }}</th>
				<th align="center" width="100">{{ trans('user.history.shop.discount') }}</th>
				<th align="center" width="140">{{ trans('user.history.created_at') }}</th>
			</tr>
			@if (count($historys))
				@foreach ($historys as $value)
					<tr>
						<td align="left">
							@if ($value->shop)
								<a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">{{ $value->shop->name }}</a>
							@else
								/
							@endif
						</td>
						<td align="left">{{ $value->shop ? $value->shop->phone : '/' }}</td>
						<td align="left">{{ $value->shop ? $value->shop->address : '/' }}</td>
						<td align="center">{{ $value->shop ? $value->shop->discount : '/' }} 折</td>
						<td align="center">{{ $value->updated_at->format('Y-m-d H:i') }}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="3" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
	{!! $historys->links() !!}
@endsection