@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.coupon') }}</h3></div>
		<ul class="tab">
			<li class="{{ request('status') == 0 ? 'on' : '' }}"><a href="{{ route('user.coupon.index', ['status' => 0]) }}"><span>未使用</span></a></li>
			<li class="{{ request('status') == 1 ? 'on' : '' }}"><a href="{{ route('user.coupon.index', ['status' => 1]) }}"><span>已使用</span></a></li>
			<li class="{{ request('status') == 2 ? 'on' : '' }}"><a href="{{ route('user.coupon.index', ['status' => 2]) }}"><span>已失效</span></a></li>
		</ul>
	</div>
	<div class="coupon-box cl">
		@if (count($coupons))
			<div class="coupon-list">
				@foreach ($coupons as $value)
					<div class="coupon-item{{ request('status') == 0 ? '' : ' coupon-item-dgray' }}">
						<div class="price"><em>¥</em><strong>{{ $value->coupon_amount }}</strong></div>
						<div class="limit">{{ $value->coupon_fullamount ? '满'.$value->coupon_fullamount.'元可用' : trans('user.unlimit')}}</div>
						<div class="time">
							@if ($value->use_start && $value->use_end)
								{{ $value->use_start->format('Y-m-d H:i') }} - {{ $value->use_end->format('Y-m-d H:i') }}
							@elseif ($value->use_start)
								{{ $value->use_start->format('Y-m-d H:i') }} - {{ trans('user.unlimit') }}
							@elseif ($value->use_end)
								{{ trans('user.unlimit') }} - {{ $value->use_end->format('Y-m-d H:i') }}
							@else
								{{ trans('user.unlimit') }}
							@endif
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="nodata">暂无数据</div>
		@endif
	</div>
	{!! $coupons->links() !!}
@endsection