@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.coupon') }}</div>
				</div>
				<div class="weui-tab" id="tab">
					<div class="weui-navbar tab_box">
						<div class="weui-navbar__item{{ request('status') == 0 ? ' weui-bar__item_on' : '' }}">
							<a href="{{ route('mobile.user.coupon.index', ['status' => 0]) }}" class="">
								<div class="title">未使用</div>
							</a>
						</div>
						<div class="weui-navbar__item{{ request('status') == 1 ? ' weui-bar__item_on' : '' }}">
							<a href="{{ route('mobile.user.coupon.index', ['status' => 1]) }}" class="">
								<div class="title">已使用</div>
							</a>
						</div>
						<div class="weui-navbar__item{{ request('status') == 2 ? ' weui-bar__item_on' : '' }}">
							<a href="{{ route('mobile.user.coupon.index', ['status' => 2]) }}" class="">
								<div class="title">已失效</div>
							</a>
						</div>
					</div>
					<div class="coupon_list">
						@foreach ($coupons as $value)
							<div class="coupon_item">
								<div class="coupon_item__hd">
									<p class="price"><i>¥</i><strong>{{ $value->coupon_amount }}</strong></p>
									<p class="desc">{{ $value->coupon_fullamount ? '满'.$value->coupon_fullamount.'元可用' : trans('user.unlimit')}}</p>
								</div>
								<div class="coupon_item__bd">
									<p class="name">{{ $value->coupon_name }}</p>
									<p class="time">
										@if ($value->use_start && $value->use_end)
											{{ $value->use_start->format('Y-m-d H:i') }} - {{ $value->use_end->format('Y-m-d H:i') }}
										@elseif ($value->use_start)
											{{ $value->use_start->format('Y-m-d H:i') }} - {{ trans('user.unlimit') }}
										@elseif ($value->use_end)
											{{ trans('user.unlimit') }} - {{ $value->use_end->format('Y-m-d H:i') }}
										@else
											{{ trans('user.unlimit') }}
										@endif
									</p>
								</div>
							</div>
						@endforeach
					</div>
					{!! $coupons->links() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
