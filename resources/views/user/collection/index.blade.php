@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.collection') }}</h3></div>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left" width="160">{{ trans('user.collection.shop') }}</th>
				<th align="left" width="120">{{ trans('user.collection.shop.phone') }}</th>
				<th align="left">{{ trans('user.collection.shop.address') }}</th>
				<th align="center" width="100">{{ trans('user.collection.shop.discount') }}</th>
				<th align="center" width="140">{{ trans('user.collection.created_at') }}</th>
				<th align="center" width="60">{{ trans('user.operation') }}</th>
			</tr>
			@if (count($collections))
				@foreach ($collections as $value)
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
						<td align="center">{{ $value->created_at->format('Y-m-d H:i') }}</td>
						<td align="center"><a href="{{ route('user.collection.delete', $value->id) }}" title="取消收藏" class="delbtn">取消收藏</a></td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6" align="center" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
	{!! $collections->links() !!}
@endsection