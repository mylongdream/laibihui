@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.redpack') }}</div>
				</div>
                <div class="redpack_list">
				@foreach ($redpacks as $value)
					<div class="redpack_item">
						<div class="redpack_item__hd">
							<p class="price"><i>¥</i><strong>{{ $value->redpack_amount }}</strong></p>
							<p class="desc">{{ $value->redpack_fullamount ? '满'.$value->redpack_fullamount.'元可用' : trans('user.unlimit')}}</p>
						</div>
                        <div class="redpack_item__bd">
							<p class="name">{{ $value->redpack_name }}</p>
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
				{!! $redpacks->links() !!}
			</div>
		</div>
	</div>
@endsection
