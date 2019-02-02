@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.coupon') }}</h3></div>
		<ul class="tab">
			<li class="{{ request('status') == 0 ? 'on' : '' }}"><a href="{{ route('mobile.user.coupon.index', ['status' => 0]) }}"><span>未使用</span></a></li>
			<li class="{{ request('status') == 1 ? 'on' : '' }}"><a href="{{ route('mobile.user.coupon.index', ['status' => 1]) }}"><span>已使用</span></a></li>
			<li class="{{ request('status') == 2 ? 'on' : '' }}"><a href="{{ route('mobile.user.coupon.index', ['status' => 2]) }}"><span>已失效</span></a></li>
		</ul>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left">{{ trans('user.coupon.remark') }}</th>
				<th align="center">{{ trans('user.coupon.coupon') }}</th>
				<th align="center" width="120">{{ trans('user.coupon.created_at') }}</th>
			</tr>
			@if (count($coupons))
				@foreach ($coupons as $value)
					<tr>
						<td align="left">{{ $value->remark }}</td>
						<td align="center">
							@if ($value->coupon > 0)
								<strong style="color:#e4393c">+{{ $value->coupon }}</strong>
                            @else
                                <strong style="color:#999999">{{ $value->coupon }}</strong>
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
	{!! $coupons->links() !!}
@endsection